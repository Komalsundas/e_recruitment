<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable = ['applicant_id', 'remark'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
