<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use App\Log;
use App\User;
use App\Category;
use Auth;
use DB;
use Exception;

class LogController extends Controller
{
    
    // private $point;
    // private $point;
    
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index','year','month']);
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
        // 初期設定
        $value_point = 130; 
        $gerge_width = 300;
        
        
        // 1時間に一回に変更する
        $user = User::where('id',Auth::user()->id)->first();
        
        // ログの作成はなし
        $last_log = Log::where('user_id', Auth::user()->id )->orderBy('created_at','desc')->first();
        $last_time =  Carbon::now()->subHour();
        if($last_log && $last_log->created_at > $last_time ){
            if($user->browsing_log){
                abort(403);
            }
            abort(404, '前回の記録からまだ1時間以上たっていません  ( Logの記録には一時間以上開けておく必要があります )');
        }
        
        // Logの作成
        $log = new Log();
        $log->user_id =  Auth::user()->id; 
        $log->month =  Carbon::now()->month;
        $log->day =  Carbon::now()->day;
        $log->time =  Carbon::now()->hour;
        // $log->time =  Carbon::now()->nowWithSameTz()->format('H:i:s');
        $log->save();
        
        // ユーザーの設定取得
        $before_level= $user->level;
        $before_point = $user->point;
        $sizeing =  $gerge_width / $user->experience_point;
        $sizeing = round($sizeing, 5 );
        
        //ユーザーの経験値上げる
        $user = $this->addPoint($user);
        
        return compact( 
            'log',
            'user',
            'value_point',
            'before_level','before_point',
            'sizeing'
        );
    } 
    
    
    // ポイントの追加
    public function addPoint(User $user){
        
        $point = 130;
        $before_point = $user->point;
        $before_experience_point = $user->experience_point;
        // ポイントを追加
        $user->point = $before_point + $point ;
        
        // レベルアップの場合
        if ($before_point+$point >= $before_experience_point ) {
            $user->level = $user->level + 1 ;  //level-up
            $user->point = $before_point+$point - $before_experience_point; //( 300+50 ) - 300 => 50 
            $user->experience_point = $before_experience_point + 50 ;
            $point = $before_experience_point - $before_point;
        }
        $user->save();
        return $user;
    }


    // ログの更新
    public function update(Request $request, Log $log)
    {
        $log->fill($request->all());
        if ($log->category) {  $log->check = true;  }
        $log->save();
        
        return $log;
    }

    public function destroy(Log $log)
    {
        $log->delete();
        return "Log削除成功";
    }
    
    
    // 募金機能
    public function donation(Request $request, Log $log)
    {
        $log->coin = 50;
        $log->save();
        return $log;
    }
    
    
    // 月別での集計を行う
    //コード汚いし重いから一部削除してもいいかも
    public function year($year)
    {
        $this->carbon_try($year, 1);
        
        $month_data = [];
        
        for ($i = 1; $i < 13; $i++) {
            
            $month_logs = Log::whereYear('created_at', $year)->whereMonth('created_at', $i);
            
            // 日付ごとのデータ
            $logs = $month_logs->select(DB::raw('count(*) as count , day as label'))->groupBy('day')->get();
            
            //再度設定
            $month_logs = Log::whereYear('created_at', $year)->whereMonth('created_at', $i);
            
            // 募金額 利用者数 利用者数(複数のクエリを防ぐため実行)
            $count =  $month_logs->count();
            $donation_count = $month_logs->sum('coin');
            $user_count = $month_logs->select(DB::raw('count(*) as count , user_id as label'))
                            ->groupBy('user_id')
                            ->get()
                            ->count('count');
                
            if (count($logs)) {
                array_push($month_data,[ 
                    'month' => $i, 
                    'data' => $logs->pluck('count') ,
                    'label' => $logs->pluck('label') ,
                    
                    
                    'donation_count' => $donation_count,
                    'user_count' => $user_count,
                    'count' => $count,
                ]);
            }
        }
        return  compact('month_data');
    }
    
    
    
    
    // ログの取得
    public function month($year,  $month)
    {
        $this->carbon_try($year, $month);
        
        // 2020/XX/1 ~ 2020/XX/1
        $date_start = Carbon::create($year,$month);
        $date_end = Carbon::create($year,$month+1);
        
        
        // あとで削除
        $logs = Log::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count , day as label'))
            ->groupBy('day')
            ->get();
        $month_count = $logs->pluck('count'); 
        $month_label = $logs->pluck('label');
        
        
        // 平均データ
        $all_logs = Log::selectRaw('count(*) / ? as count', [24])->groupBy('day')->get();
        $month_count_ave = $all_logs->pluck('count');
        
        
        // sexデータ (エラーの可能あり)
        //回数に対しての利用人数
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(DISTINCT user_id) as count, sex as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('sex')
            ->orderBy('count', 'desc' )
            ->get();
        $sex_data = $logs->pluck('count'); 
        $sex_data_label = $logs->pluck('label');
        $sex_data_user = $logs->pluck('user_count');
        
        
        
        // categoryデータ
        $logs =  Category::join('logs', 'categories.id', '=', 'logs.category_id')
            ->select(DB::raw('count(*) as count, categories.name as label, categories.color as color '), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('category_id')
            ->orderBy('count', 'desc')
            ->get();
        
        $category_data = $logs->pluck('count'); 
        $category_data_label = $logs->pluck('label');
        $category_data_color = $logs->pluck('color');
        
        
        
        // coinデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('sum(coin) as count, day as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('day')
            ->get();
        $coin_data = $logs->pluck('count'); 
        $coin_data_label = $logs->pluck('label');
        
        //先月のデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('sum(coin) as count, day as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month-1)
            ->groupBy('day')
            ->get();
        $last_month_coin_data = $logs->pluck('count'); 
        $last_month_coin_data_label = $logs->pluck('label');
        
        $user_all = User::all()->count();
        return compact(
            'month',
            'month_count','month_count_ave','month_label',
            'sex_data','sex_data_label',
            'sex_data_user',
            'category_data','category_data_label','category_data_color',
            'coin_data','coin_data_label',
            'last_month_coin_data', 'last_month_coin_data_label',
            'user_all'
        );
            
            
    }
    
    
    
    
    // Urlパラメータが正しいのか検証
    private function carbon_try($year, $month){
        try{
            return Carbon::create($year,$month);
        }catch(Exception $e){
            return abort(404);
        }
    }
    
    
}

