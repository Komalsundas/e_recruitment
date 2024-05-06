<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalVacanciesTable extends Migration
{
    public function up()
    {
        Schema::create('historical_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->integer('slot');
            $table->string('tor');
            // Add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historical_vacancies');
    }
}
