<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyJob extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = ['id', 'company_id', 'job_name', 'job_description', 'job_level'];

    public $timestamps = false;

    public function jobSkills()
    {
        return $this->belongsToMany(
            JobSkill::class,
            'job_skill_maps',
            'company_job_id',
            'job_skill_id'
        );
    }

}
