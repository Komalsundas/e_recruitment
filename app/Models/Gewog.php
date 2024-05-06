<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gewog extends Model
{
    use HasFactory;
    protected $fillable = [
        'gewog_name',
        'dzo_id'
    ];
    public function dzongkhag()
    {
        return $this->belongsTo(Dzongkhag::class, 'dzo_id', 'id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'gewog_id', 'id');
    }
}

