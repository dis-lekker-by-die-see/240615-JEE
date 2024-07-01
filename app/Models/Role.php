<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'role_id';
    protected $fillable = ['role_name'];

    public function users()
    {
        //return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
        //return $this->belongsToMany(User::class, 'role_id', 'id');
        return $this->hasMany(User::class, 'role_id');
    }
}
