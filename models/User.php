<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'password',
        'first_name',
        'last_name',
        'role_id'
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function strides(){
        return $this->hasMany(Stride::class);
    }

    public function trainings(){
        return $this->hasMany(Training::class);
    }

    public function userTrainings(){
        return $this->hasMany(UserTraining::class);
    }
}