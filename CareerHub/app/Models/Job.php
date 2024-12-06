<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'company_id', 'job_name', 'job_description', 'job_level'];

    public $timestamps = false;

    public function job_skills()
    {
        return $this->belongsToMany(
            JobSkill::class,
            'job_skill_maps',
            'job_id',
            'job_skill_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
