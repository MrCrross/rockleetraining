<?php

namespace Migrations;

use Throwable;
use Seeders\DatabaseSeeder;

class Migrate
{
    protected $migrations = [];
    protected $seed;

    public function __construct()
    {
        $this->migrations['roles'] = new CreateRolesTable;
        $this->migrations['training_types'] = new CreateTrainingTypesTable;
        $this->migrations['exercise_types'] = new CreateExerciseTypesTable;
        $this->migrations['users'] = new CreateUsersTable;
        $this->migrations['trainings'] = new CreateTrainingsTable;
        $this->migrations['exercises'] = new CreateExercisesTable;
        $this->migrations['user_trainings'] = new CreateUserTrainingsTable;
        $this->migrations['user_executions'] = new CreateUserExecutionsTable;
        $this->seed = new DatabaseSeeder;
    }

    /**
     * Создание базы + заполнение
     */
    public function migrateAndSeed()
    {
        $this->migrate();
        $this->seed();
    }

    /**
     * Создание базы
     */
    public function migrate()
    {
        try {
            foreach ($this->migrations as $migration) {
                $migration->up();
                echo get_class($migration) . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
    }

    /**
     * Вызов метода для заполнения тестовыми данными базу
     */
    private function seed()
    {
        $this->seed->run();
    }

    /**
     * Пересоздание базы + заполнение
     */
    public function freshAndSeed()
    {
        $this->fresh();
        $this->seed();
    }

    /**
     * Пересоздание базы
     */
    public function fresh()
    {
        try {
            $migrations = array_reverse($this->migrations);
            foreach ($migrations as $migration) {
                $migration->down();
                echo get_class($migration) . ' удален успешно<br>';
            }
            foreach ($this->migrations as $migration) {
                $migration->up();
                echo get_class($migration) . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
    }

    /**
     * Полное удаление базы данных
     */
    public function drop()
    {
        try {
            $migrations = array_reverse($this->migrations);
            foreach ($migrations as $migration) {
                $migration->down();
                echo get_class($migration) . ' удален успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }
    }
}