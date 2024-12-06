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

    public function jobs()
    {
        return $this->belongsToMany(
            Job::class,
            'job_skill_maps',
            'job_skill_id',
            'job_id'
        );
    }

    public $timestamps = false;
}
