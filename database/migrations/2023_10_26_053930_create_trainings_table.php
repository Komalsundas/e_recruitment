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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('training')->nullable();
            $table->string('country')->nullable();
            $table->date('sdate')->nullable();
            $table->date('edate')->nullable();
            // $table->string('reason');
            $table->string('certificates')->nullable();
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
        Schema::dropIfExists('trainings');
    }
};
