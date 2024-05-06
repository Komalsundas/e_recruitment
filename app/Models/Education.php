<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute',
        'year',
        'course_name',
        'grade',
        'stream',
        'eng',
        'dzo',
        'math',
        'phy',
        'che',
        'bio',
        'eco',
        'it',
        'com',
        'acc',
        'his',
        'geo',
        'ent',
        'agfs',
        'media',
        'rigzhung',
        'aggregate',
        'marksheet',
        'applicant_id'
        // Add other fields as needed
    ];
}
