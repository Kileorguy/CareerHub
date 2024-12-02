<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
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

  public function company_jobs(): HasMany
  {
    return $this->hasMany(CompanyJob::class, 'company_id', 'id');
  }

  public function user(): HasOne
  {
    return $this->hasOne(User::class, 'company_id', 'id');
  }
}
