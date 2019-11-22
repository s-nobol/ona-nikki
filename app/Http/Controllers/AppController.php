<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;
use DB;
use App\Log;
use Exception;
class AppController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        return view('home');
    }

    public function home()
    {
        return view('home');
    }
    
    public function information()
    {
        return view('home');
    }
    
    
    public function ranking()
    {
        return view('app.ranking');
    }
    
    
    // みんなのグラフ
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
        
        
        $all_logs = Log::
                selectRaw('count(*) / ? as count', [24])
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