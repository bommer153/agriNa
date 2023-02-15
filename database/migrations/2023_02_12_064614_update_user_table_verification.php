<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {           
            $table->string('contact')->nullable();   
            $table->string('smscode')->nullable();     
            $table->string('smsverification')->nullable();     
         });

         Schema::table('chats', function (Blueprint $table) {           
            $table->string('seen')->nullable(); 
            $table->string('seen2')->nullable();              
         });

         Schema::table('carts', function (Blueprint $table) {           
            $table->string('unitPrice')->nullable();                    
         });

      
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
