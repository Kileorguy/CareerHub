<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
  public $incrementing = false;
  protected $table = 'companies';
  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'name',
    'city',
    'country',
    'description',
    'profile_picture',
  ];

  public $timestamps = false;

  public function jobs(): HasMany
  {
    return $this->hasMany(Job::class, 'company_id', 'id');
  }

  public function user(): HasOne
  {
    return $this->hasOne(User::class, 'company_id', 'id');
  }
}
