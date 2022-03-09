<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class UserTraining extends Model
{
    protected $fillable = [
        'training_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function training(){
        return $this->belongsTo(Training::class)->orderBy('name');
    }
}