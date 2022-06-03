<?php

return [
    // Главная страница
    '' => [
        'controller' => 'MainController',
        'action' => 'index'
    ],
    // личный кабинет
    'lk'=>[
        'controller' => 'MainController',
        'action' => 'lk'
    ],
    // Вывод определенной категории на главной странице
    'types/type\d{1,}' => [
        'controller' => 'MainController',
        'action' => 'view'
    ],
    // Страница Входа
    'login' => [
        'controller' => 'AuthController',
        'action' => 'login'
    ],
    // Страница регистрации
    'registration' => [
        'controller' => 'AuthController',
        'action' => 'registration'
    ],
    // тренировки
    'trainings'=>[
        'controller' => 'TrainingController',
        'action' => 'index'
    ],
    'trainings/create'=>[
        'controller' => 'TrainingController',
        'action' => 'create'
    ],
    'trainings/edit'=>[
        'controller' => 'TrainingController',
        'action' => 'edit'
    ],
    // тренировки которые выполняет пользователь
    'my_trainings'=>[
        'controller' => 'TrainingController',
        'action' => 'my'
    ],
    'my_trainings/track'=>[
        'controller' => 'TrainingController',
        'action' => 'track'
    ],
    'my_trainings/order'=>[
        'controller' => 'TrainingController',
        'action' => 'order'
    ],

    // Админка

    'admin'=>[
        'controller' => 'AdminController',
        'action' => 'index'
    ],
    // Страница Добавление пользователя администратором
    'admin/users/create'=>[
        'controller'=>'AdminController',
        'action'=>'createUser'
    ],
    // Страница редактирования пользователей администратором
    'admin/users/edit'=>[
        'controller'=>'AdminController',
        'action'=>'editUser'
    ],
    // Страница удаление пользователей администратором
    'admin/users/delete'=>[
        'controller'=>'AdminController',
        'action'=>'deleteUser'
    ],
    'admin/trainings/create'=>[
        'controller'=>'AdminController',
        'action'=>'createTraining'
    ],
    'admin/trainings/edit'=>[
        'controller'=>'AdminController',
        'action'=>'editTraining'
    ],

    // API

    // Обработка входа
    'api/login' => [
        'controller' => 'AuthController',
        'action' => 'auth'
    ],
    // Обработка регистрации
    'api/registration' => [
        'controller' => 'AuthController',
        'action' => 'reg'
    ],
    // Выход
    'api/logout' => [
        'controller' => 'AuthController',
        'action' => 'logout'
    ],
    'api/trainings/insert'=>[
        'controller' => 'TrainingController',
        'action' => 'insert'
    ],
    // добавление тренировки в занятия пользователя
    'api/trainings/insertMy'=>[
        'controller' => 'TrainingController',
        'action' => 'insertMy'
    ],
    'api/trainings/update'=>[
        'controller' => 'TrainingController',
        'action' => 'update'
    ],
    // удаление тренировки пользователя
    'api/trainings/delete'=>[
        'controller' => 'TrainingController',
        'action' => 'delete'
    ],
    // удаление тренировки из занятий пользователя
    'api/trainings/deleteMy'=>[
        'controller' => 'TrainingController',
        'action' => 'deleteMy'
    ],
    // Добавление пользователя администратором
    'api/user/create' => [
        'controller' => 'UserController',
        'action' => 'create'
    ],
    // Изменить данные пользователя
    'api/user/update' => [
        'controller' => 'UserController',
        'action' => 'update'
    ],
    // Удаление пользователя администратором
    'api/user/delete' => [
        'controller' => 'UserController',
        'action' => 'delete'
    ],
    // Изменить пароль пользователя
    'api/user/changePassword' => [
        'controller' => 'UserController',
        'action' => 'changePassword'
    ],
    'api/types/training/insert'=>[
        'controller' => 'TrainingTypeController',
        'action' => 'insert'
    ],
    'api/types/training/update'=>[
        'controller' => 'TrainingTypeController',
        'action' => 'update'
    ],
    'api/types/training/delete'=>[
        'controller' => 'TrainingTypeController',
        'action' => 'delete'
    ],
    'api/types/exercise/insert'=>[
        'controller' => 'ExerciseTypeController',
        'action' => 'insert'
    ],
    'api/types/exercise/update'=>[
        'controller' => 'ExerciseTypeController',
        'action' => 'update'
    ],
    'api/types/exercise/delete'=>[
        'controller' => 'ExerciseTypeController',
        'action' => 'delete'
    ],
    'api/execution' => [
        'controller' => 'TrainingController',
        'action' => 'execution'
    ],
    //Миграции
    'admin/migrate/fresh' => [
        'controller' => 'MigrateController',
        'action' => 'fresh'
    ],
    'admin/migrate/freshAndSeed' => [
        'controller' => 'MigrateController',
        'action' => 'freshAndSeed'
    ],
    'admin/migrate' => [
        'controller' => 'MigrateController',
        'action' => 'migrate'
    ],
    'admin/migrateAndSeed' => [
        'controller' => 'MigrateController',
        'action' => 'migrate'
    ],
];