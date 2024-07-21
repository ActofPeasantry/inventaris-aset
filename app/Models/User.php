<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'nik', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }


    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }


    public function pengesahanTransaksi()
    {
        return $this->hasMany(PengesahanTransaksi::class);
    }

    public function aset()
    {
        return $this->hasMany(Aset::class);
    }

    public function asetRusak()
    {
        return $this->hasMany(AsetRusak::class);
    }

    /**
     * Check if user has a role.
     * @var int
     * @return bool
     */
    public function hasAnyRole($role)
    {
        return null !== $this->userRoles()->where('role_id', $role)->first();
    }
    public function isAdmin()
    {
        return $this->hasAnyRole(UserRole::ADMIN);
    }
    public function isKepalaDinas()
    {
        return $this->hasAnyRole(UserRole::KEPALA_DINAS);
    }
    public function isPegawai()
    {
        return $this->hasAnyRole(UserRole::PEGAWAI);
    }



    // /**
    //  * Get the user's full name.
    //  *
    //  * @return string
    //  */
    // public function getFullNameAttribute()
    // {
    //     if (is_null($this->last_name)) {
    //         return "{$this->name}";
    //     }

    //     return "{$this->name} {$this->last_name}";
    // }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

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
}
