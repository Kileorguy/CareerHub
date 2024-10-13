<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['uuid', 'company_name', 'country', 'location', 'city', 'position_name', 'job_level', 'job_type', 'job_summary','profile_picture'];
}