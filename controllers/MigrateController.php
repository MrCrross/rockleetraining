<?php

namespace Controllers;

use Core\Controller;
use Core\Database;
use Core\View;
use Migrations\Migrate;

class MigrateController extends Controller
{

    private $migrate;

    public function __construct($route)
    {
        parent::__construct($route);
        if (MIGRATE != 'true') {
            View::redirect('/');
            exit;
        }
        new Database();
        $this->migrate = new Migrate;
    }

    public function migrate()
    {
        // Выполнение миграций базы данных
        $this->migrate->migrate();
    }

    public function migrateAndSeed()
    {
        // Выполнение миграций базы данных
        $this->migrate->migrateAndSeed();
    }

    public function fresh()
    {
        // Выполнение миграций базы данных
        $this->migrate->fresh();
    }

    public function freshAndSeed()
    {
        // Выполнение миграций базы данных
        $this->migrate->freshAndSeed();
    }

}