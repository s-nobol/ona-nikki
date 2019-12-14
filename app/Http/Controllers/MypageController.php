<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use App\Log;
use App\User;
use App\Category;

class MypageController extends Controller
{
    
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function mypage()
    {
        // 過去一か月のデータ取得
        $select_month = Carbon::now()->subDays(30);
        
        // 過去一か月のデータ取得
        $logs = Auth::user()->logs()
            ->where( 'created_at', '>', $select_month)
            ->select(DB::raw('count(*) as count, day as label '))
            ->groupBy('day')
            ->get(); 
            
        $month_data = $logs->pluck('count') ;
        $month_data_label  = $logs->pluck('label'); 
        
        // 平均回数
            
        // 過去一か月のデータ取得
        $carbon = new Carbon();
        $year = $carbon->year;
        $month = $carbon->month-1;
        $last_monnt_logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count, day as label '))
            ->groupBy('day')
            ->get();
        $last_monnt_data = $last_monnt_logs->pluck('count');
        $last_month_data_label = $last_monnt_logs->pluck('label');
        
        // 1年間の月別平均射精回数
        
        // timeデータ
        $time_logs = Auth::user()->logs()
            ->where( 'created_at', '>', $select_month)
            ->select(DB::raw('count(*) as count, time  as label '))
            ->groupBy('time')
            ->get(); 
        $time_data = $time_logs->pluck('count') ;
        $time_data_label  = $time_logs->pluck('label'); 
        
        // カテゴリーデータ
        $logs = Auth::user()->logs()
            ->where( 'created_at', '>', $select_month)
            ->select(DB::raw('count(*) as count, category as label '))
            ->groupBy('category')
            ->orderBy('count','desc')
            ->get(); 
            
        $category_data = $logs->pluck('count') ;
        $category_data_label  = $logs->pluck('label'); 
        
        // 最新のデータ
        $new_data = Auth::user()->logs()
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();
            
        
        // カレンダーのデータ
        $logs = Log::
            select(DB::raw('count(*) as count, day as label, created_at'))
            ->where( 'created_at', '>', $select_month)
            ->groupBy('day')
            ->take(10)
            ->get();
        $day_data = $logs->pluck('created_at') ;
            
            
        return compact(
            'month_data','last_monnt_data',
            'month_data_label', 'last_month_data_label',
            'time_data', 'time_data_label',
            'category_data', 'category_data_label',
            'new_data',
            'day_data'
            );
    }
    
    
    
    // 月別での集計を行う
    public function year($year)
    {
        // return "logd";
        $this->carbon_try($year, 1);
        
        
        //日付ごとに集計
        $logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as count, month as label '))
            ->groupBy('month')
            ->get();
          
        $month_data = $logs->pluck('count') ;
        $month_data_label  = $logs->pluck('label'); 
          
        // みんなの平均値
        $user_count = User::all()->count();
        $otherlogs = Log::whereYear('created_at', $year)
                ->selectRaw('count(*) / ? as count', [$user_count])
            // ->select(DB::raw('count(*) / ? as count', [$user_count]))
            ->groupBy('month')
            ->get();
        $otherlogs = $otherlogs->pluck('count');
        
        
        
        
        // // 日付ごとの利用日数グラフ
        // $logs = Auth::user()->logs()
        //     ->whereYear('created_at', $year)
        //     ->select(DB::raw('count(*) as count, day as label, month'))
        //     ->groupBy('month','day')
        //     ->get();
        // $user = User::where('id',103)->first()->delete();
        // $user->delete;
        
        //エラーがでるかも？
        $logs = Log::
            whereYear('created_at', $year )
            ->where('user_id', Auth::user()->id )
            ->select(  DB::raw("count(*) as count, strftime('%m-%d', created_at) as label"))
            ->groupBy('label')
            ->get();
        
        $day_data = $logs->pluck('count'); 
        $day_data_label = $logs->pluck('label') ;
        $day_data_count = $logs->count() ;
        
        
        // カテゴリーデータ
        $logs =  Category::join('logs', 'categories.id', '=', 'logs.category_id')
            ->select(DB::raw('count(*) as count, categories.name as label, categories.color as color '), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->where('user_id', Auth::user()->id )
            ->groupBy('category_id')
            ->orderBy('count', 'desc')
            ->take(7)
            ->get();
        
        $category_data = $logs->pluck('count'); 
        $category_data_label = $logs->pluck('label');
        $category_data_color = $logs->pluck('color');
        
        
        
        // coinデータ
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('sum(coin) as count, day as label'), DB::raw(' logs.created_at as created_time'))
            ->whereYear('created_time', $year)
            ->where('user_id', Auth::user()->id )
            ->groupBy('day')
            ->get();
        
        $coin_data = $logs->pluck('count'); 
        $coin_data_label = $logs->pluck('label');
        
        

        return compact( 
            'month_data', 'month_data_label',
            
            'day_data','day_data_label','day_data_count',
            'category_data','category_data_label','category_data_color',
            'coin_data','coin_data_label'         
        );
    }
    
    
    
    // 最新のLog 30件
    public function logs()
    {
        $id = Auth::user()->id;
        $logs = Log::where('user_id', $id )
                ->orderBy('created_at', 'desc')
                ->take(30)
                ->get();
        return compact('logs');
    }

    public function quest()
    {
        
    }
    
        
    // すべてのデータ(今のところ利用なし)
    public function all_data()
    {
        // 月ごとにソートすると2018年11月と2019年11月がかぶる
        $logs = Auth::user()->logs()
            ->select(
                DB::raw('count(*) as count '), 
                DB::raw("strftime('%Y-%m', created_at) label"),
                DB::raw("strftime('%Y', created_at) year"),
                DB::raw("strftime('%m', created_at) months"))
            ->groupBy('year','months')
            ->get();
        return $logs;
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
