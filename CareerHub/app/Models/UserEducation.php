<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'education_name',
        'major',
        'gpa',
        'start_date',
        'end_date'
    ];
}
