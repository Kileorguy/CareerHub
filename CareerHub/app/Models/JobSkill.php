<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'skill_name'
    ];

    public function companyJobs()
    {
        return $this->belongsToMany(
            CompanyJob::class,
            'job_skill_maps',
            'job_skill_id',
            'company_job_id'
        );
    }

    public $timestamps = false;
}
