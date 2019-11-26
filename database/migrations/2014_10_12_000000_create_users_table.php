<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            
            
            
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            
            // Level設定
            $table->integer('level')->default(1); //level
            $table->integer('experience_point')->default(0);  //経験値
            $table->integer('point')->default(0);  //経験値(現在)
            
            // ユーザー設定
            $table->string('age')->nullable();     //年齢
            $table->string('sex')->nullable();     //性別
            $table->string('location')->nullable(); //住所 Locationに変更する
            $table->boolean('receive_email')->default(true); //メール(月ごとの集計)を受信する？
            $table->string('theme')->default("red");  //テーマ
            
            // クエスト    
            
            
             // ソーシャルログイン用(name email は初期設定でいいかも？)
            $table->boolean('oauth_check')->default(false);; //ソーシャルユーザーでログインしているか？
            $table->string('oauth_image')->nullable(); //画像
            // $table->string('oauth_id')->nullable();
            // $table->string('oauth_name')->nullable();
            // $table->unique(['oauth_id', 'oauth_name']);
            
            
            // 管理者
            $table->smallInteger('role')->default(0); //管理者権限3以上
            
            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
