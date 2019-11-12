<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Log;

class AppController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::check()) {
            return view('mypage');
        }
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
        $logs  = "後日追加"; 
        
        
        $logs = Log::whereYear('created_at', $year)
            ->select(DB::raw('count(*) as count , id, month'))
            ->groupBy('month')
            ->get();
        
        $test_logs =  "test";
        
        return view('log.year',compact('logs','test_logs'));
    }
    
    
    
    
    // ログの取得
    
    public function month($year,  $month)
    {
        
        // 2020/XX/1 ~ 2020/XX/1
        
        
        $date_start = Carbon::create($year,$month);
        $date_end = Carbon::create($year,$month+1);
        
        // 日付ごとの集計
        $logs = Log::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count , id'))
            // ->groupBy('time')
            ->get();
        
        $test_logs =  "test";
        return view('log.month',compact('month','logs','test_logs'));
    }
    
}
