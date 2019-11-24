<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use App\Log;
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
        // month 削除
        
        $logs = new Log();
        $logs->user_id =  Auth::user()->id; 
        $logs->month =  Carbon::now()->month;
        $logs->day =  Carbon::now()->day;
        $logs->time =  Carbon::now()->nowWithSameTz()->format('H:i:s');
        $logs->save();
        
        return $logs;
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
