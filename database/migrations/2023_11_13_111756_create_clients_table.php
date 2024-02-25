<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');           
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('vegetable_name')->nullable();
            $table->string('amber');
            $table->string('fridge');
            $table->string('location')->nullable();
            $table->enum('status', ['dealer','person'])->default('dealer');
            //one//
             $table->string('price_all')->nullable();
             $table->string('quantity')->nullable();
            //two//
            $table->string('ton')->nullable();
            $table->string('small_shakara')->nullable();
            $table->string('big_shakara')->nullable();
            $table->unsignedBigInteger('price_list_id')->nullable();
            $table->foreign('price_list_id')->references('id')->on('price_lists')->onDelete('cascade');          
            //three//
            $table->string('avrage')->nullable();
            $table->string('shakayir')->nullable();
            $table->string('price_one')->nullable();
            //relation//
            $table->unsignedBigInteger('term_id')->nullable();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            //
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            //
            $table->unsignedBigInteger('amber_id');  
            $table->foreign('amber_id')->references('id')->on('ambers')->onDelete('cascade');
            //  
            $table->unsignedBigInteger('fridge_id');  
            $table->foreign('fridge_id')->references('id')->on('fridges')->onDelete('cascade');          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
