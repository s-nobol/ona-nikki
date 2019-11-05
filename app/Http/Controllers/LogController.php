<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LogController extends Controller
{
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
        
        $logs = new Log();
        $logs->user_id =  Auth::user()->id; 
        $logs->time =  Carbon::now()->nowWithSameTz()->format('H:i:s');
        $logs->save();
        
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
    
        $log = $log->fill($request->all());
        $log->save();
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
        //
    }
    
    
    public function year($year)
    {
        $logs  = "後日追加";
        return view('log.year')->with([ 'logs' => $logs ]);
    }
    public function month($month)
    {
        $logs  = "後日追加";
        return view('log.month')->with([ 'logs' => $logs ]);
    }
}
