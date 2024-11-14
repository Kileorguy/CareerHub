<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAwards extends Model
{
    use HasFactory;

    protected $table = 'user_awards';
    protected $fillable = [

    ];
    public $timestamps = false;
}
