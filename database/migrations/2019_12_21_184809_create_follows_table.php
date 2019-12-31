<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            
            //フォロワーのID
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('followed_id')->unsigned();
            
            
            // 一致をさける
            $table->unique(['user_id', 'followed_id']);
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
            
            
            // Flamer
            // $table->bigInteger('flamer_id')->unsigned();
            // $table->foreign('flamer_id')->references('id')->on('flamers')->onDelete('cascade');
            
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
        Schema::dropIfExists('follows');
    }
}
