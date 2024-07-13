<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nama_role'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function userRole()
    {
        return $this->hasMany(UserRole::class);
    }

    public function getRoleNameByUserId($user_id)
    {
        $userRole = UserRole::where('user_id', $user_id)->first();
        if ($userRole) {
            $role = Role::where('id', $userRole->role_id)->first();
            return $role->nama_role;
        } else {
            return null;
        }
    }
}
