<?php

namespace Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StaticSeeder::class,
            UserSeeder::class,
            TrainingSeeder::class,
        ]);
    }
}
