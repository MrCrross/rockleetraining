<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Controller
{
    public $route;
    public $view;
    public $auth;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->auth = 'guest';
        new Database();
        if (!$this->checkRule()) {
            View::errors(403);
        }
    }

    public function checkRule()
    {
        $rules = require_once 'Config\account.php';
        if (isset($_SESSION['user'])) {
            $this->auth = json_decode($_SESSION['user'])->role->name;
        }
        if (in_array($this->route['name'], $rules[$this->auth])) return true;
        return false;
    }

    public static function getAutoIncrement($db, $table)
    {
        return Capsule::select(
            'SELECT AUTO_INCREMENT 
                FROM information_schema.TABLES 
                where TABLE_SCHEMA = ?
                AND TABLE_NAME=?', [$db, $table])[0]->AUTO_INCREMENT;
    }

    public static function getMessage()
    {
        $message = '';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        return $message;
    }
}