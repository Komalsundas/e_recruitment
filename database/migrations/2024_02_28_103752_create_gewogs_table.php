<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gewogs', function (Blueprint $table) {
            $table->id();
            $table->string('gewog_name');
            $table->foreignId('dzo_id')->constrained('dzongkhags');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('gewogs');
    }
};