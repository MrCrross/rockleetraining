<?php

namespace Seeders;

use Illuminate\Database\Seeder;
use Models\ExerciseType;
use Models\Role;
use Models\TrainingType;
use Throwable;

class StaticSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'user'
            ],
        ];

        $training_types = [
            [
                'name' => 'Легкая тренировка'
            ],
            [
                'name' => 'Усложненная тренировка'
            ],
            [
                'name' => 'Сложная тренировка'
            ],
        ];
        $exercise_types = [
            [
                'name' => 'Простое упражнение'
            ],
            [
                'name' => 'Усложненное упражнение'
            ],
            [
                'name' => 'Сложное упражнение'
            ],
        ];

        try {
            foreach ($roles as $role) {
                Role::create([
                    'name' => $role["name"]
                ]);
                echo 'Role '.$role["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
        try {
            foreach ($training_types as $training_type) {
                TrainingType::create([
                    'name' => $training_type["name"]
                ]);
                echo 'TrainingType '.$training_type["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
        try {
            foreach ($exercise_types as $exercise_type) {
                ExerciseType::create([
                    'name' => $exercise_type["name"]
                ]);
                echo 'ExerciseType '.$exercise_type["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
    }
}