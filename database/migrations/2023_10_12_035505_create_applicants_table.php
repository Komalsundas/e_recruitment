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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cid')->unique();
            $table->string('dob');
            $table->string('contact');
            $table->string('acontact');
            $table->string('gender');
            $table->string('email');
            $table->string('dzongkhag');
            $table->string('gewog');
            $table->string('village');
            $table->string('present_address');
            $table->string('passport_photo');
            $table->string('coverletter');
            $table->string('cidcopy');
            $table->string('cv');
            $table->string('mc');
            $table->string('noc');
            $table->string('vacancy_id');
            $table->string('x_percentage')->nullable();
            $table->string('xii_percent')->nullable();
            $table->string('degree_percentage')->nullable();
            $table->string('final_score')->nullable();
            $table->string('status')->default('In process');
            $table->boolean('shortlisted')->default(false);
            // $table->boolean('selected')->default(false);
            $table->integer('selected')->default(0);
            $table->integer('standby')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
