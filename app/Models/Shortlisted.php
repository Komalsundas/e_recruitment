<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlisted extends Model
{
    protected $fillable = ['applicant_id', 'vacancy_id'];
    
    // Define relationships
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
}
}