<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->tinyInteger('time');
            
            $table->string('category')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('check')->default(false); //もしカテゴリーが入力されていたらチェック
            // $table->integer('')->nullable(); 費やした時間
            
            
            
            // $table->integer('coin')->nullable();//コイン
            $table->integer('coin')->default(0);//コイン
            
            
            $table->timestamps();
            
            
            // User
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            //Category
            $table->integer('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
