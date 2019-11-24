<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use App\Log;
use App\User;

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
            
        
        return compact(
            'month_data','last_monnt_data',
            'month_data_label', 'last_month_data_label',
            'time_data', 'time_data_label',
            'category_data', 'category_data_label',
            'new_data'
            );
    }
    
    
    
    // 月別での集計を行う
    public function year($year)
    {
        // return "logd";
        $this->carbon_try($year, 1);
        
        $month_data = [];
        
        //日付ごとに集計
        $logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as count, month as label '))
            ->groupBy('month')
            ->get();
          
        $user_count = User::all()->count();
        // return $user_count;
        // みんなの平均値
        $otherlogs = Log::whereYear('created_at', $year)
                ->selectRaw('count(*) / ? as count', [$user_count])
            // ->select(DB::raw('count(*) / ? as count', [$user_count]))
            ->groupBy('month')
            ->get();
            
        $month_data_label  = $logs->pluck('label'); 
        $month_data_count = $logs->pluck('count') ;
        $otherlogs = $otherlogs->pluck('count');
        
        // 時間帯別グラフ
        $time_logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as count, time as label '))
            ->groupBy('time')
            ->get();
            
        $time_data = $time_logs->pluck('count') ;
        $time_data_label = $time_logs->pluck('label') ;
        
            
            
        return compact(
            'month_data',
            'otherlogs' ,
            
            'month_data_count', 'month_data_label',
            
            'time_data', 'time_data_label'
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
    
    // 月ごとのデータ
    public function month_data()
    {
        $carbon = new Carbon();
        $year = $carbon->year;
        $month = $carbon->month;
        $logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count, day as label '))
            ->groupBy('day')
            ->get();
        
        $data = $logs->pluck('count');
        $data_label = $logs->pluck('label');
            
        return compact( 'data', 'data_label');
    }
    
    
    // 一年間のデータ
    public function year_data()
    {
        $carbon = new Carbon();
        $month = $carbon->month;
        $year = $carbon->subYear();
        
        $logs = Auth::user()->logs()
            ->whereYear('created_at', $year)
            // ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count, month as label '))
            ->groupBy('month')
            ->get();
        
        $data = $logs->pluck('count');
        $data_label = $logs->pluck('label');
        
        return compact( 'data', 'data_label');
    }
    
    
    // すべてのデータ
    public function all_data()
    {
        // 月ごとにソートすると2018年11月と2019年11月がかぶる
        // データべースごとに実行を変える
        $logs = Auth::user()->logs()
            ->select(
                DB::raw('count(*) as count '), 
                DB::raw("strftime('%Y-%m', created_at) label"),
                DB::raw("strftime('%Y', created_at) year"),
                DB::raw("strftime('%m', created_at) months"))
            ->groupBy('year','months')
            ->get();
            
            
        $data = $logs->pluck('count');
        $data_label = $logs->pluck('label');
        
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
