<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Panel as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Panel name
        'email', // Panel email
        'password', // Panel password (hashed)
        'panel_contact', // Panel contact information
        'vacancy_id', // ID of the vacancy associated with the panel
    ];

    // Define any relationships here, if needed
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
