<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Auth;
use DB;
use Carbon\Carbon;

use App\User;
use App\Log;
class Home_Api_Test extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $log;
    private $date;
    private $sex;
    private $address;
    private $time;
    /**
     * A basic feature test example.
     *      ./vendor/bin/phpunit tests/Feature/Logs/Home_Api_Test.php
     * @return void
     */    
    public function setUp():void
    {
        parent::setUp();
        
        $sex =["男","女"];
        $address = ["大阪","東京","名古屋"];
        $time = [1,2,3,4];
        $id=0;
        for ($i = 1; $i < 11; $i++) {
            $date = new Carbon('2019-11-25');
            $date->hour = $i; 
            if ($i % 2 == 0) { $id = 0 ;}else{ $id = 1; }
            $this->user = factory(User::class)->create(['id'=> $i, 'sex' => $sex[$id], 'location'=> $address[$i%3]]);
            $this->Log = factory(Log::class)->create([ 
                'user_id' => $i,   'created_at' => $date ,'time' =>$time[$i%4] 
                ]);
        }
        
        // 2019年11月24日のデータ作成
        $date = new Carbon('2019-11-24 01:00:00');
        $this->Log = factory(Log::class)->create([  'user_id' => 1 ,  'created_at' => $date ,]);
                
        // 2018年のデータ作成
        $date = new Carbon('2018-11-25 01:00:00');
        $this->Log = factory(Log::class)->create([    'user_id' => 1 ,  'created_at' => $date ,]);
        $this->date = new Carbon('2019-11-25  00:00:00');
        $this->sex = $sex;
        $this->address = $address;
        $this->time = $time;
    }
    
        
    /**
     * 
     * @aurl
     * amazon.com/api/home
     * @return
     * 'data','data_label',
     * 'time_data', 'time_data_label',
     * 'location_data','location_data_label',
     * 'sex_data','sex_data_label'
     * 
     * data data_label
    **/
    public function test_Api_home正しい値を取得できるか？()
    {   
        
        $response = $this->get('/api/home');
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        $response->assertJson([
            'data' => [],
            'data_label' => [],
            'time_data' => [],
            'time_data_label' => [],
            'location_data' => [],
            'location_data_label' => [],
            'sex_data' => [],
            'sex_data_label' => []
        ]);
        
        
    }
    
    
    
    
    // メソッドの確認
    // public function test_DB_days日付のデータ取得できるか()
    // {   
    //     $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
    //         ->select(DB::raw('logs.created_at as created_time'))
    //         ->where( 'created_time', '>', $this->date)
    //         ->get();
    //     $this->assertEquals(10, $logs->count());
    // }
     
    // public function test_DB_time日付のデータ取得できるか()
    // {   
    //     $string = "time"; 
    //     $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
    //         ->select(DB::raw('count(*) as count,'.$string.' as label'), DB::raw(' logs.created_at as created_time'))
    //         ->groupBy($string)
    //         ->where( 'created_time', '>', $this->date)
    //         ->get();
    //     $this->assertEquals(count($this->time), $logs->count());
    // }
    
    
    // public function test_DB_Sexのデータ取得できるか()
    // {   
    //     $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
    //         ->select(DB::raw('count(*) as count, sex as label'), DB::raw(' logs.created_at as created_time'))
    //         ->groupBy('sex')
    //         ->where( 'created_time', '>', $this->date)
    //         ->get();
        
    //     $this->assertEquals(count($this->sex) , $logs->count());
    // }
    
    // public function test_DB_Locationのデータ取得できるか()
    // {   
    //     $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
    //         ->select(DB::raw('count(*) as count, location as label'), DB::raw(' logs.created_at as created_time'))
    //         ->groupBy('location')
    //         ->where( 'created_time', '>', $this->date)
    //         ->get();
    //     $this->assertEquals(count($this->address) , $logs->count());
    // }
    
    
}
