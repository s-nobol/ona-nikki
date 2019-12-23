<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;
use DB;
use App\Log;
use App\User;
use App\Category;
use Exception;
class AppController extends Controller
{
    
    
    
    public function home()
    {
        
        // 1日のデータ取得
        $date = Carbon::now()->subDays(8);
        
        
        // 1日のデータ取得
        $logs = Log::select(DB::raw('count(*) as count '))->where( 'created_at', '>', $date)->get();
        $data = $logs->pluck('count');  
        $data_label = $logs->pluck('label'); 
        
        
        
        // 地域ごとのデータ
        $location_logs = $this->DB_abstract('location', $date);
        $location_data = $location_logs->pluck('count');  
        $location_data_label = $location_logs->pluck('label');
        
        
        // 性別ごとのデータ
        $sex_logs =  $this->DB_abstract('sex', $date)->SortByDesc('count');
        $sex_data = $sex_logs->pluck('count');  
        $sex_data_label = $sex_logs->pluck('label');
        
        
        // 時間ごとの利用者
        $time_logs =  $this->DB_abstract('time', $date);
        $time_data = $time_logs->pluck('count');  
        $time_data_label = $time_logs->pluck('label');  
        
        // 過去一週間のデータ
        $week = Carbon::now()->subDays(7);
        $week_logs = $this->DB_abstract('day', $week);
        $week_data = $week_logs->pluck('count');  
        $week_data_label = $week_logs->pluck('label');
        
        
        
        // カテゴリーデータ
        $logs =  Category::join('logs', 'categories.id', '=', 'logs.category_id')
            ->select(DB::raw('count(*) as count, categories.name as label, categories.color as color '),
            DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $date)
            ->groupBy('category_id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
        $category_data = $logs->pluck('count'); 
        $category_data_label = $logs->pluck('label');
        $category_data_color = $logs->pluck('color');
        
        
        //最新のデータ
        $new_data =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('*,logs.created_at as created_time'))
            ->orderBy('created_time','desc')
            ->take(10)
            ->get();
        
        
   
        // coinデータ
        $logs =  Log::select(DB::raw('sum(coin) as count, day as label'))
            ->where('created_at','>', $date)
            ->groupBy('day')
            ->get();
        $donation_data = $logs->pluck('count'); 
        $donation_data_label = $logs->pluck('label');
        
        
        // 一か月のデータカウンター
        $month_date = Carbon::now()->subDays(18);
        $month_data_count = Log::where('created_at','>', $month_date)->get()->count();
        
        
        
        return  compact(
            'data','data_label',
            'location_data','location_data_label',
            'sex_data','sex_data_label',
            
            'time_data', 'time_data_label',
            'week_data','week_data_label',
            
            'category_data', 'category_data_label', 'category_data_color',
            
            'donation_data','donation_data_label',
            'new_data',
            'month_data_count'
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
            ->orderBy('count','desc')
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
        $age_logs = User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, age as label'))
            ->groupBy('age')
            ->get();
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
        // 年齢別デー��
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
        
        // $logs = $this->DB_ranking('user_id', $date, 20);
        
        
        
        $logs =    User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select('*',  DB::raw('count(*) as count, user_id as label'), 
            DB::raw(' logs.created_at as created_time'), 
            DB::raw(' users.id as id'))
            ->groupBy('user_id')
            ->where( 'created_time', '>', $date)
            ->orderBy('count','desc')
            ->take(20)
            // ->with('followers')
            ->get();
            
        
        return $logs;
        
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
            ->select('*', 
            DB::raw('count(*) as count, '.$string.' as label'), 
            DB::raw(' logs.created_at as created_time'), 
            DB::raw(' users.id as user_id'))
            ->groupBy($string)
            ->where( 'created_time', '>', $date)
            ->orderBy('count','desc')
            ->take($take)
            ->get();
    }
    
    
}