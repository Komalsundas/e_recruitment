<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreatePanelsTable extends Migration
{
    public function up()
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default(Hash::make('123456789')); // Set default password
            $table->string('panel_contact');
            // $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('panels');
    }
}

