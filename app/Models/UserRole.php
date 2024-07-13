<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_roles';
    protected $fillable = ['user_id', 'role_id'];

    /** stand-in for role's number */
    const ADMIN = 1;
    const KEPALA_DINAS = 2;
    const PEGAWAI = 3;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
