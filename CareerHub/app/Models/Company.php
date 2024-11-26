<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
  protected $table = 'companies';
  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'company_name',
    'country',
    'location',
    'city',
    'profile_picture'
  ];

  public $timestamps = false;

  public function company_jobs(): HasMany
  {
    return $this->hasMany(CompanyJob::class, 'company_id', 'id');
  }
}
