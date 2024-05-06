<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Applicant extends Model
{
    use HasFactory;
    const STATUS_SELECTED = 1;
    const STATUS_STANDBY = 2;

    protected $fillable = [
        'name',
        'cid',
        'dob',
        'gender',
        'contact',
        'acontact',
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
        'noc',
        'vacancy_id',
        'final_score',
        'x_percentage',
        'xii_percent',
        'degree_percentage',
        'status',
        'shortlisted',
        'selected',
        'standby'


        
        // Add other fields as needed
    ];
    

    /**
     * Additional fields that may be conditionally fillable.
     *
     * @var array
     */
    protected $additionalFillable = [];

    /**
     * Determine additional fillable fields based on minQualification.
     *
     * @param  int  $minQualification
     * @return array
     */
    public function determineAdditionalFillable(int $minQualification): array
{
    $additionalFields = [];

    if ($minQualification == 6) {
        $additionalFields = ['x_percentage'];
    } elseif ($minQualification == 5) {
        $additionalFields = ['x_percentage', 'xii_percent'];
    } elseif ($minQualification == 2 || $minQualification == 3) {
        $additionalFields = ['x_percentage', 'xii_percent', 'degree_percentage'];
    }
    
    return $additionalFields;
}
// public function training()
// {
//     return $this->hasOne(Training::class);
// }

    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        return array_merge($this->fillable, $this->additionalFillable);
    }
}
