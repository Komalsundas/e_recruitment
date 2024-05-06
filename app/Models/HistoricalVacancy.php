<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalVacancy extends Model
{
    use HasFactory;

    protected $table = 'historical_vacancies';

    protected $fillable = [
        'position',
        'slot',
        'tor',
        // Add other attributes as needed
    ];
}
