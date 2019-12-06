<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use App\Log;
use App\User;
use Auth;
use DB;
use Exception;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->authorizeResource(Log::class, 'log');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
        dd( Carbon::now()->nowWithSameTz()->format('H:i:s')); 
     */
    public function store(Request $request)
    {
        // 1時間に一回に変更する
        $user = User::where('id',Auth::user()->id)->first();
        $last_log = Log::where('user_id', Auth::user()->id )->orderBy('created_at','desc')->first();
        $last_time =  Carbon::now()->subHour();
        if($last_log && $last_log->created_at > $last_time ){
            if($user->browsing_log){
                abort(403);
            }
            abort(404, '前回の記録からまだ1時間以上たっていません  ( Logの記録には一時間以上開けておく必要があります )');
        }
        
        // Logの作成
        $logs = new Log();
        $logs->user_id =  Auth::user()->id; 
        $logs->month =  Carbon::now()->month;
        $logs->day =  Carbon::now()->day;
        $logs->time =  Carbon::now()->nowWithSameTz()->format('H:i:s');
        $logs->save();
        
        // ユーザーの更新
        $before_level= $user->level;
        $before_point = $user->point;
        
        // 初期設定
        $value_point = 130; 
        $gerge_width = 300;
        
        //ユーザーの経験値上げる
        $user = $this->addPoint($user);
        
        $sizeing =  $gerge_width / $user->experience_point;
        $sizeing = round($sizeing, 5 );
        
        
        return compact( 
            'logs',
            'user',
            'value_point',
            'before_level','before_point',
            'sizeing'
        );
    }  
    public function addPoint(User $user){
        $user->point = $user->point + 130;
        $user->save();
        return $user;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        $log = $log->fill($request->all());
        $log->save();
        return $log;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        $log->delete();
        return "Log削除成功";
    }
    
    /**
    *
    * MtpageControllerにも同じもの作った
    * 
    */
    // 月ごとのデータ
    public function my_month_data()
    {
        $carbon = new Carbon();
        $year = $carbon->year;
        $month = $carbon->month;
        $month_logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count, day as label '))
            ->groupBy('day')
            ->get();
        
        $monht_data = $month_logs->pluck('count');
        $month_data_label = $month_logs->pluck('label');
            
        return compact( 'data', 'data_label');
    }
    
    
    // 一年間のデータ
    public function my_year_data()
    {
        $carbon = new Carbon();
        $month = $carbon->month;
        $year = $carbon->subYear();
        
        $year_logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count, day as label '))
            ->groupBy('day')
            ->get();
        
        $year_data = $year_logs->pluck('count');
        $year_data_label = $year_logs->pluck('label');
        
        return compact( 'data', 'data_label');
    }
    
    
    // すべてのデータ
    public function my_all_data()
    {
        
        $logs = Auth::user()->logs()
            ->select(DB::raw('count(*) as count '),
             DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  
             DB::raw('YEAR(created_at) year, MONTH(created_at) months'))
            ->groupBy('year','months')
            ->get();
        $all_data = $logs->pluck('count');
        $all_data_label = $logs->pluck('label');
        
        return compact( 'data', 'data_label');
    }
    
    
    
    
    
    
    // Urlパラメータが正しいのか検証
    private function carbon_try($year, $month){
        try{
            return Carbon::create($year,$month);
        }catch(Exception $e){
            abort(404);
            return false;
        }
    }
    
}
