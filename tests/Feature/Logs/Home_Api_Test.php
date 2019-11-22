<?php

namespace Tests\Feature\Logs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Log;
class Home_Api_Test extends TestCase
{
     
    use RefreshDatabase;
    private $user;
    private $log;
    /**
     * A basic feature test example.
     *      ./vendor/bin/phpunit tests/Feature/Logs/Home_Api_Test.php
     * @return void
     */    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        
    }
    
        
    public function test_Api_2019年のみデータ取得できるか()
    {        
       
        // 2018/1~2020/12月までひと月づつ作成
        $year = 2018;
        for ($month = 1; $month < 13; $month++) {
            $this->log = factory(Log::class)->create([
                'user_id' => $this->user->id ,
                'created_at' => new Carbon($year.'-'.$month.'-7') ,
                'month' => $month ,
            ]); 
        }
    
        $year = 2019;
        for ($month = 1; $month < 13; $month++) {
            $this->log = factory(Log::class)->create([
                'user_id' => $this->user->id ,
                'created_at' => new Carbon($year.'-'.$month.'-7') ,
                'month' => $month ,
            ]); 
        }
        
        $year = 2020;
        for ($month = 1; $month < 13; $month++) {
            $this->log = factory(Log::class)->create([
                'user_id' => $this->user->id ,
                'created_at' => new Carbon($year.'-'.$month.'-7') ,
                'month' => $month ,
            ]); 
        }
        
        $response = $this->get('/api/logs/2019');
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        for ($month = 1; $month < 13; $month++) {
            $response->assertJson([
                "month_data"=> [
                   $month-1 =>  [
                        "month" =>$month ,
                        "data"=> [ 1 ],
                    ]
                ],
            ]);
        }
        
    }
    
    
        
    public function test_Api_2019年のデータは正しくデータか()
    {       
       
        
        // 2019の1月がらひと月増すごとにデータが一つづつ増えていく
        // 1月は1のデータ  2月は2のデータ  3月は3のデータ 。。。。　12月は12のデータ
        
        $year = 2019;
        for ($month = 1; $month < 13; $month++) {
            for ($count = 0; $count < $month; $count++) {
                $this->log = factory(Log::class)->create([
                    'user_id' => $this->user->id ,
                    'created_at' => new Carbon($year.'-'.$month.'-8') ,
                    'day' => $month ,
                ]); 
            }
        }
        
        $response = $this->get('/api/logs/2019');
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        for ($month = 1; $month < 13; $month++) {
            $response->assertJson([
                "month_data"=> [
                    
                    $month-1 =>  [
                        "month" =>$month ,
                        "data"=> [ 0 =>$month ], //該当月分だけデータがそんざいする
                    ]
                    
                ],
            ]);
        }
        
        
        // 1月のデータを追加する
        $month = 1;
        $this->log = factory(Log::class)->create([
                    'user_id' => $this->user->id ,
                    'created_at' => new Carbon($year.'-'.$month.'-8') ,
                    'day' => $month ,
        ]); 
        
        
        $response = $this->get('/api/logs/2019');
        $response->assertStatus(200);
        // 1月のデータは増えているはず
        $response->assertJson([
            "month_data"=> [
                
                $month-1 =>  [
                    "month" =>$month ,
                    "data"=> [ 0 =>2 ], 
                ]
                
            ],
        ]);
    }
    public function test_Api_2019年1月のみデータ取得できるか()
    {  
        
        
        //2019年1月1日30日
        $year = 2019;
        $month = 1;
        for ($month = 1; $month < 13; $month++) {
            $this->log = factory(Log::class)->create([
                'user_id' => $this->user->id ,
                'created_at' => new Carbon($year.'-'.$month.'-8') ,
                'day' => $month ,
            ]); 
        }
        
        
        $response = $this->get('/api/logs/2019/1');
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        $response->assertJson([
            "month" => 1,
            // 1つづつデータを作成しているのでデータは一つ
            "month_count"=> [
                1
            ],
        ]);
        
        
    }
     public function test_Api_2019年1月のデータは正しいデータか(){
        
        $year = 2019;
        $month = 1;
        for ($day= 1; $day < 31; $day++) {
            for ($count = 0; $count < $day; $count++) {
                
                $this->log = factory(Log::class)->create([
                    'user_id' => $this->user->id ,
                    'created_at' => new Carbon($year.'-'.$month.'-7') ,
                    'day' => $day ,
                ]); 
            }
        }
        // ダミーデータ2
        $year = 2019;
        $month = 2;
        for ($day= 1; $day < 31; $day++) {
            for ($count = 0; $count < $day; $count++) {
                $this->log = factory(Log::class)->create([
                    'user_id' => $this->user->id ,
                    'created_at' => new Carbon($year.'-'.$month.'-7') ,
                    'day' => $day ,
                ]); 
            }
        }
        
        // ダミーデータ2
        $year = 2018;
        $month = 1;
        for ($day= 1; $day < 31; $day++) {
            for ($count = 0; $count < $day; $count++) {
                $this->log = factory(Log::class)->create([
                    'user_id' => $this->user->id ,
                    'created_at' => new Carbon($year.'-'.$month.'-7') ,
                    'day' => $day ,
                ]); 
            }
        }
        
        
        $response = $this->get('/api/logs/2019/1');
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        for ($day= 1; $day < 31; $day++) {
            $response->assertJson([
                "month" => 1,
                "month_count"=> [
                    $day-1 => $day
                ],
            ]);
        }
    }
}
