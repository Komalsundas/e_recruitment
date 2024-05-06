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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('position');
            $table->integer('minQualification');
            $table->string('course');
            $table->string('criteria');
            $table->decimal('class10marks', 5, 2)->nullable();
            $table->decimal('class12marks', 5, 2)->nullable();
            $table->decimal('degreemarks', 5, 2)->nullable();
            $table->string('remuneration');
            $table->string('grade');
            $table->integer('slot');
            $table->integer('empType');
            $table->string('tor');
            $table->datetime('dateline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function minQualification()
    {
        return $this->hasOne(MinQualification::class);
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
