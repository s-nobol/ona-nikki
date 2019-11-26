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
class Sex_Api_Test extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $log;
    private $date;
    private $age;
    private $sex;
    private $address;
    private $time;
    /**
     * A basic feature test example.
     *      ./vendor/bin/phpunit tests/Feature/Logs/Sex_Api_Test.php
     * @return void
     */    
    public function setUp():void
    {
        parent::setUp();
        
        $age = [1,2,3,4];
        $sex =["男","女"];
        $address = ["大阪","東京","名古屋"];
        $time = [1,2,3,4];
        $id=0;
        $date = new Carbon('2019-11-25');
        
        for ($i = 1; $i < 30; $i++) {
            if ($i % 2 == 0) { $id = 0 ;}else{ $id = 1; }
            
            $this->user = factory(User::class)->create([
                'age' => rand(1,4),
                'sex' => $sex[$id], 
                'location'=> $address[$i%3]
                ]);
            
            $this->Log = factory(Log::class)->create([ 
                'user_id' => $i,  
                'created_at' => $date ,
                'time' =>$time[$i%4] 
                ]);
                
        }
        
        $this->date = new Carbon('2019');
        $this->age = $age;
        $this->sex = $sex;
        $this->address = $address;
        $this->time = $time;
    }
    
        
    /**
     * 
     * @aurl
     * amazon.com/api/home
     * @return
     * 'data','data_label'
     * 'sex_data','sex_data_label'
     * ''
     * 
     * data data_label
    **/
    public function test_Api_sex正しい値を取得できるか？()
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
    
    
    
    
    
 
    
    
    // データベースで実装できるか検証
    public function test_DB_sex_dataデータ取得できるか()
    {   
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, sex as label'), DB::raw(' logs.created_at as created_time'))
            ->groupBy('sex')
            ->get();
        $count = $logs->pluck('count');
        $label= $logs->pluck('label');
        $this->assertEquals(count($this->sex) ,count($label));
    }  
    
    public function test_DB_sex_age_dataデータ取得できるか()
    {   
        $logs =  User::join('logs', 'users.id', '=', 'logs.user_id')
            ->select(DB::raw('count(*) as count, age as label'), DB::raw(' logs.created_at as created_time'))
            ->where( 'sex', '男')
            ->groupBy('sex','age')
            ->get();
            
        // 半分にする
        $this->assertEquals(count($this->age) , $logs->count());
    }
    
    
}
