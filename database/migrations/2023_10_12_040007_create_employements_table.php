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
        Schema::create('employements', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('post')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('place')->nullable();
            // $table->string('reason');
            $table->string('document')->nullable();
            // $table->string('skills')->nullable();  
            $table->integer('applicant_id')->nullable();
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employements');
    }
};