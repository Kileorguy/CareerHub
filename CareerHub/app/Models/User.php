<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'short_description',
        'github_link',
        'portofolio_link',
        'role',
        'profile_link'
    ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(UserCertificate::class);
    }

    public function awards(): HasMany
    {
        return $this->hasMany(UserAwards::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(UserExperience::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(UserSkills::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(UserProjects::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(UserEducation::class);
    }



}
