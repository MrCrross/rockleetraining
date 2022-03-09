<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public static function getOrder()
    {
        $t = new ExerciseType();
        return $t->order();
    }

    public function order()
    {
        return $this->orderBy('name')->get();
    }
}