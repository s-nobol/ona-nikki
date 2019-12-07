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
        
        $ranking_data = $this->DB_ranking('user_id',$week, 5);
        
        return  compact(
            'data','data_label',
            'time_data', 'time_data_label',
            'location_data','location_data_label',
            'sex_data','sex_data_label',
            'week_data','week_data_label',
            'ranking_data'
            );
    }
    
    
    
    
    public function sex()
    {  
        
        // 性別データ
        $date = Carbon::now()->subDays(500);
        $string = 'sex';
        $logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->orderBy('sex','desc')
            ->get();
        $data = $logs->pluck('count');  
        $data_label = $logs->pluck('label');
        
        
        // 男性の年代別利用データ
        $man_logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, age as label'), DB::raw(' logs.created_at as created_time'))
            ->where( 'sex', '男')
            ->groupBy('sex','age')
            ->get();
        $man_data = $man_logs->pluck('count');  
        $man_data_label = $man_logs->pluck('label');
        
        
        // 女性の年代別利用データ
        $woman_logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, age as label'), DB::raw(' logs.created_at as created_time'))
            ->where( 'sex', '女')
            ->groupBy('sex','age')
            ->get();
        $woman_data = $woman_logs->pluck('count');  
        $woman_data_label = $woman_logs->pluck('label');
        
        
        // 女性の年代別利用データ
        $age_logs = $this->DB_abstract('age', $date);
        $age_data = $age_logs->pluck('count');  
        $age_data_label = $age_logs->pluck('label');
        
        return  compact(
            'data','data_label',
            'man_data','man_data_label',
            'woman_data','woman_data_label',
            'age_data','age_data_label'
        );
    }
    
    
    public function locations()
    {  
        // 年齢別データ
        $logs = User::select(DB::raw('count(*) as count, location as label'))
            ->groupBy('location')
            ->get(); 
        $location = $logs->pluck('label');
        return compact('location');
    }
    // ユーザーが一人しかいないのでデータが取れない
    public function location($name)
    {  
        
        // 年齢別データ
        $date = Carbon::now()->subDays(500);
        $string = 'age';
        $logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where('location', $name)
            ->get();
        $age_data = $logs->pluck('count');;  
        $age_data_label = $logs->pluck('label');
        
        
        // 性別データ
        $string = 'sex';
        $sex_logs = User::where('location', $name)
            ->select(DB::raw('count(*) as count, '.$string.' as label'))
            ->groupBy($string)
            ->get();
        $sex_data = $sex_logs->pluck('count');  
        $sex_data_label = $sex_logs->pluck('label');
        
        
        // 月別データ
        $date = Carbon::now()->subDays(90);
        $string = 'month';
        $month_logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where('location', $name)
            ->where( 'created_time', '>', $date)
            ->get();
        $month_data = $month_logs->pluck('count');  
        $month_data_label = $month_logs->pluck('label');
        
        // 全国の利用率平均利用
        $logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) / 8 as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where( 'created_time', '>', $date)
            ->get();;
        $month_data_all = $logs->pluck('count');  
        
        
        // 年齢別データ
        $date = Carbon::now()->subDays(500);
        $logs = $this->DB_abstract('location', $date);
        $location_data = $logs->pluck('label');
        
        
        return  compact(
            'age_data','age_data_label',
            'sex_data','sex_data_label',
            'location_data',
            'month_data', 'month_data_label',
            'month_data_all'
        );
    }
    
    
    
    
    
    public function ranking($name)
    {   
        $date;
        if ($name == "week") {
            $date = Carbon::now()->subDays(7);
        }else if ($name == "month") {
            $date = Carbon::now()->subDays(30);
        }else if ($name == "all") {
            $date = Carbon::now()->subDays(500);
        }
        
        $logs = $this->DB_ranking('user_id', $date, 20);
        return $logs;
        // return  compact( 'logs', 'currentUser_Ranking');
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
    
    
    public function DB_ranking($string, $date, $take)
    {   
        return  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select('*', DB::raw('count(*) as count, '.$string.' as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy($string)
            ->where( 'created_time', '>', $date)
            ->orderBy('count','desc')
            ->take($take)
            ->get();
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
        
        
        // 平均データ
        $all_logs = Log::selectRaw('count(*) / ? as count', [24])
                ->groupBy('day')
                ->get();
        $month_count_ave = $all_logs->pluck('count');
        
        
        // sexデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, sex as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('sex')
            ->get();
        $sex_data = $logs->pluck('count'); 
        $sex_data_label = $logs->pluck('label');
        
        
        // categoryデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, category as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('category')
            ->get();
        
        $category_data = $logs->pluck('count'); 
        $category_data_label = $logs->pluck('label');
        
        
        // categoryデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, category as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->whereMonth('created_time', $month)
            ->groupBy('day')
            ->get();
        
        $coin_data = $logs->pluck('count'); 
        $coin_data_label = $logs->pluck('label');
        
        return compact(
            'month',
            'month_count','month_count_ave','month_label',
            'sex_data','sex_data_label',
            'category_data','category_data_label',
            'coin_data','coin_data_label' 
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