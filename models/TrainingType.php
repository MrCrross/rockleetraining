<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public static function getOrder()
    {
        $t = new TrainingType();
        return $t->order();
    }

    public function order()
    {
        return $this->orderBy('name')->get();
    }
}