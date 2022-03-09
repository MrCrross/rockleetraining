<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'level',
        'exercise_type_id',
        'time',
        'training_id'
    ];

    public function exerciseType(){
        return $this->belongsTo(ExerciseType::class);
    }
    public function training(){
        return $this->belongsTo(Training::class);
    }
    public function strides(){
        return $this->hasMany(Stride::class);
    }
}