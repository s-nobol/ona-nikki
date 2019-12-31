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
class Location_Api_Test extends TestCase
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
     *      ./vendor/bin/phpunit tests/Feature/Logs/Location_Api_Test.php
     * @return void
     */    
    public function setUp():void
    {
        parent::setUp();
        
        $sex =["男","女"];
        $address = ["北海道","関東","関西"];
        $time = [1,2,3,4,5];
        $id = 0;
        
        for ($i = 1; $i < 10; $i++) {
            $date = new Carbon('2019-11-25');
            $date->hour = $i+1; 
            
            $this->user = factory(User::class)->create([ 
                'id' => $i,
                'sex' => $sex[$id%2], 
                'location'=> $address[$i%3]
                // 'location'=> $address[0]
            ]);
            
            $this->Log = factory(Log::class)->create([ 
                'user_id' => $i,  
                'created_at' => $date ,
                'time' => $time[$i%4] 
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
    public function test_Api_location正しい値を取得できるか？()
    {   
        $name = $this->address[0];
        $response = $this->get('/api/location/'.$name);
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        $response->assertJson([
            'age_data' => [],
            'age_data_label' => [],
            'sex_data' => [],
            'sex_data_label' => []
        ]);
        
        
    }
    
    
    
    
    
    public function test_DBデータ取得できるか()
    {   
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, location as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy('location')
            ->where( 'location',$this->address[0])
            ->get();
        $this->assertEquals(1 , $logs->count());
        // $this->assertEquals(count($this->address) , $logs->count());
    }
    
    
}
