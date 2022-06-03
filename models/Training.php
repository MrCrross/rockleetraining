<?php

namespace Models;

use Core\Auth;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'name',
        'training_type_id',
        'user_id'
    ];

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class)->orderBy('level');
    }

    public function userTrainings()
    {
        return $this->hasMany(UserTraining::class)->where('user_id',Auth::user()->id);
    }
    public function userExecutions()
    {
        return $this->hasMany(UserExecution::class)->where('user_id',Auth::user()->id);
    }
}