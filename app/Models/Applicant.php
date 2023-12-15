<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cid',
        'dob',
        'gender',
        'contact',
        'email',
        'dzongkhag',
        'gewog',
        'village',
        'present_address',
        'passport_photo',
        'coverletter',
        'cidcopy',
        'cv',
        'mc',
        'vacancy_id',
        'final_score'
        // Add other fields as needed
    ];
}
