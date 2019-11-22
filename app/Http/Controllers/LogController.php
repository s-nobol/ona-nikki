<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->authorizeResource(Log::class, 'log');  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 自分のLogのみ
        // $logs  = Auth::user()->logs->latest();
        $logs = Log::where('user_id',Auth::user()->id)->latest()->get();
        return view('log.index')->with([ 'logs' => $logs ]);
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
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
        return view('log.show')->with([ 'logs' => $log ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
        return view('log.edit')->with([ 'log' => $log ]);
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
        // dd($log);
        $log = $log->fill($request->all());
        $log->save();
        // return $log;
        return view('log.edit')->with([ 'log' => $log ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
    }
    
    
    
    // 月別での集計を行う
    public function year($year)
    {
        
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
        
        // エラーが発生したら400を返す
        // dd($carbon);
        
        $date_start = Carbon::create($year,$month);
        $date_end = Carbon::create($year,$month+1);
        // dd($date_end);
        $logs = Log::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('count(*) as count , id'))
            // ->groupBy('time')
            ->get();
        
        $test_logs =  "test";
        // $logs = $logs->pluck('count');//countのみ取得
        
        return view('log.month',compact('month','logs','test_logs'));
    }
    
    private function test_method($date){
        $date_start = "開始日";
        $date_end = "終了日";
        Log::select(DB::raw('count(*) as count , id'))
            ->where('created_at','>', $date_start)->where('created_at','<', $date_end)
            ->groupBy('time')
            ->get();
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
