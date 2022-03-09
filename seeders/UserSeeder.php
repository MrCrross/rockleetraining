<?php

namespace Seeders;

use Illuminate\Database\Seeder;
use Models\User;
use Throwable;

class UserSeeder extends Seeder
{

    public function run()
    {

        $users = [
            [
                'name' => 'root',
                'password' => hash('sha256', 'qweqwe123'),
                'first_name' => 'Петр',
                'last_name' => 'Петров',
                'role_id' => 1,
            ],
            [
                'name' => 'user',
                'password' => hash('sha256', 'qweqwe123'),
                'first_name' => 'Петр',
                'last_name' => 'Петров',
                'role_id' => 2,
            ]
        ];
        try {
            foreach ($users as $user) {
                User::create([
                    'name' => $user["name"],
                    'password' => $user["password"],
                    'first_name' => $user["first_name"],
                    'last_name' => $user["last_name"],
                    'role_id' => $user["role_id"],
                ]);
                echo 'User '.$user["name"] . ' выполнен успешно<br>';
            }
        } catch (Throwable $e) {
            echo 'Ошибка :' . $e;
        }

    }
}