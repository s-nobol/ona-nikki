<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;
use DB;
use App\Log;
use App\User;
use Exception;
class AppController extends Controller
{
    
    public function information()
    {
        return view('home');
    }
    
    
    public function home()
    {
        
        // 1日のデータ取得
        $date = Carbon::now()->subDays(1);
        
        
        // 1日のデータ取得
        $logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select('*', DB::raw('logs.created_at as created_time , day as label'))
            ->where( 'created_time', '>', $date);
        
        // データべースのかぶりが発生している
        
        // 時間ごとの利用者
        $data = $logs;  
        $data_label = $logs->pluck('label'); 
        
        
        // 時間ごとの利用者
        $time_logs =  $this->DB_abstract('time', $date);
        $time_data = $time_logs->pluck('count');  
        $time_data_label = $time_logs->pluck('label');  
        
        
        // 地域ごとのデータ
        $location_logs = $this->DB_abstract('location', $date);
        $location_data = $location_logs->pluck('count');  
        $location_data_label = $location_logs->pluck('label');
        
        
        // 性別ごとのデータ
        $sex_logs =  $this->DB_abstract('sex', $date);
        $sex_data = $sex_logs->pluck('count');  
        $sex_data_label = $sex_logs->pluck('label');
        
        
        // 地域ごとのデータ
        $week = Carbon::now()->subDays(7);
        $week_logs = $this->DB_abstract('day', $week);
        $week_data = $week_logs->pluck('count');  
        $week_data_label = $week_logs->pluck('label');
        
        $ranking_data = $this->DB_ranking('user_id',$week);
        return  compact(
            'date',
            'data','data_label',
            'time_data', 'time_data_label',
            'location_data','location_data_label',
            'sex_data','sex_data_label',
            'week_data','week_data_label',
            'ranking_data'
            );
    }
    
    // 抽象的なデータベースの取得
    public function DB_abstract($string, $date)
    {   
        return  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where( 'created_time', '>', $date)
            ->get();
    }
    
    public function DB_ranking($string, $date)
    {   
        return  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select('*', DB::raw('count(*) as count, user_id as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where( 'created_time', '>', $date)
            ->orderBy('count','desc')
            ->take(5)
            ->get();
    }
    
    public function ranking()
    {
        return view('app.ranking');
    }
    
    
    // 月別での集計を行う
    public function year($year)
    {
        $this->carbon_try($year, 1);
        
        $month_data = [];
        
        for ($i = 1; $i < 13; $i++) {
            
            //日付ごとに集計
            $logs = Log::whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->select(DB::raw('count(*) as count , day as label'))
                ->groupBy('day')
                ->get();
            
            
            if (count($logs)) {
                array_push($month_data,[ 
                    'month' => $i, 
                    'data' => $logs->pluck('count') ,
                    'label' => $logs->pluck('label') 
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
        $month_count_ave = "";
        
        
        $all_logs = Log::selectRaw('count(*) / ? as count', [24])
                ->groupBy('day')
                ->get();
        $month_count_ave = $all_logs->pluck('count');
        
        return compact('month','logs','month_count','month_count_ave','month_label');
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

// 日付ごとの集計
// $logs = Log::whereYear('created_at', $year)
//     ->whereMonth('created_at', $month)
//     ->select(DB::raw('count(*) as count , id'))
//     ->groupBy('day') 
//     ->get();