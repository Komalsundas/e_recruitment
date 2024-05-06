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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('institute')->nullable();
            $table->integer('year')->nullable();
            $table->string('course_name')->nullable();
            $table->integer('grade')->nullable();
            $table->char('stream')->nullable();
            $table->integer('eng')->nullable();
            $table->integer('dzo')->nullable();
            $table->integer('math')->nullable();
            $table->integer('phy')->nullable();
            $table->integer('che')->nullable();
            $table->integer('bio')->nullable();
            $table->integer('eco')->nullable();
            $table->integer('it')->nullable();
            $table->integer('com')->nullable();
            $table->integer('acc')->nullable();
            $table->integer('his')->nullable();
            $table->integer('geo')->nullable();
            $table->integer('ent')->nullable();
            $table->integer('agfs')->nullable();
            $table->integer('media')->nullable();
            $table->integer('rigzhung')->nullable();
            $table->string('aggregate')->nullable();
            $table->string('marksheet')->nullable();
            $table->integer('applicant_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};