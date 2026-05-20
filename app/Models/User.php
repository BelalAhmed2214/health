<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\SectionEnum;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'is_admin', 'section'];

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'section'           => SectionEnum::class,
        ];
    }

    /** Super Admin: is_admin = true, section = null */
    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /** Section user: is_admin = false, section = 'agamy'|'dekhila' */
    public function isSectionUser(): bool
    {
        return !$this->is_admin && $this->section !== null;
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
