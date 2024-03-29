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
            $table->integer('point')->default(0);  //経験値(現在)
            $table->integer('experience_point')->default(300);  //経験値(あるレベルにおいて必要なポイント)
            $table->boolean('browsing_log')->default(false); //ブラウザを開いた瞬間にCreateLog
            
            // ユーザー設定
            $table->string('age')->nullable();     //年齢
            $table->string('sex')->nullable();     //性別
            $table->string('location')->nullable(); //住所 Locationに変更する
            $table->string('career')->nullable(); //住所 Locationに変更する？
            $table->boolean('status_check')->default(false);
            
            
          
            // $table->string('oauth_id')->nullable();  // ソーシャルログイン用(name email は初期設定でいいかも？)
            $table->boolean('oauth_check')->default(false); //ソーシャルユーザーでログインしているか？
            $table->string('oauth_image')->nullable(); //画像
            
            
            $table->boolean('receive_email')->default(true); //メール(月ごとの集計)を受信する
            
            
            $table->string('theme')->default("red");  //テーマ(いらない)
            
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
