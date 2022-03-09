<?php

namespace Seeders;

use Illuminate\Database\Seeder;
use Models\Exercise;
use Models\Stride;
use Models\Training;
use Throwable;

class TrainingSeeder extends Seeder
{
    public function run()
    {
        $trainings = [
            [
                'name' => 'Простой комплекс',
                'training_type_id' => 1,
                'user_id' => 2
            ],
            [
                'name' => 'Средний комплекс',
                'training_type_id' => 2,
                'user_id' => 1
            ],
            [
                'name' => 'Сложный комплекс',
                'training_type_id' => 3,
                'user_id' => 1
            ],
        ];

        $exercises = [
            [
                'name' => 'Разминаем кисти',
                'description' => 'Круговращение кистей, по часовой половину времени и против часовой вторую половину, сцепив вместе.',
                'time' => 100,
                'level'=>1,
                'exercise_type_id' => 1,
                'training_id' => 1
            ],
            [
                'name' => 'Приседание',
                'description' => 'Возьмите руки вместе и выполните сгибание и разгибание ног до 90 градусов.',
                'time' => '100',
                'level'=>2,
                'exercise_type_id' => 1,
                'training_id' => 1
            ],
            [
                'name' => 'Разминаем кисти',
                'description' => 'Круговращение кистей, по часовой половину времени и против часовой вторую половину, сцепив вместе.',
                'time' => 100,
                'level'=>1,
                'exercise_type_id' => 1,
                'training_id' => 2
            ],
            [
                'name' => 'Отжимание',
                'description' => 'В стойке "Упор лёжа" выполняйте сгибание и разгибание рук до 90 градусов.',
                'time' => 100,
                'level'=>2,
                'exercise_type_id' => 1,
                'training_id' => 2
            ],
            [
                'name' => 'Разминаем кисти',
                'description' => 'Круговращение кистей, по часовой половину времени и против часовой вторую половину, сцепив вместе.',
                'time' => 100,
                'level'=>1,
                'exercise_type_id' => 1,
                'training_id' => 3
            ],
        ];
        try {
            foreach ($trainings as $training) {
                Training::create([
                    'name' => $training["name"],
                    'training_type_id' => $training["training_type_id"],
                    'user_id' => $training["user_id"],
                ]);
                echo 'Training '.$training["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
        try {
            foreach ($exercises as $exercise) {
                Exercise::create([
                    'name' => $exercise["name"],
                    'description' => $exercise["description"],
                    'time' => $exercise["time"],
                    'level' => $exercise["level"],
                    'exercise_type_id' => $exercise["exercise_type_id"],
                    'training_id' => $exercise["training_id"]
                ]);
                echo 'Exercise '. $exercise["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }

    }
}