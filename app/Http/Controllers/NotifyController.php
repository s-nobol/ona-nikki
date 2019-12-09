<?php

namespace App\Http\Controllers;

use App\Notify;
use Illuminate\Http\Request;

use App\Http\Requests\NotifyRequest;
use Carbon\Carbon;
use Auth;
use DB;
use Exception;

class NotifyController extends Controller
{
    
       public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        // $this->authorizeResource(Log::class, 'log');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ページネーション
        // $notify = Notify::all();
        $notify = Notify::orderBy('created_at','desc')->paginate(10); 
        return $notify;
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotifyRequest $request)
    {
        //
        $notify = Notify::create($request->all());
        return $notify;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function show(Notify $notify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function edit(Notify $notify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function update(NotifyRequest $request, Notify $notify)
    {
        $notify->fill($request->all());
        $notify->save();
        return $notify;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notify $notify)
    {
        //
        // $notify->delete();
        return "お知らせを削除しました";
    }
}
