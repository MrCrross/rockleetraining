<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Core\View;
use Illuminate\Database\Capsule\Manager as Capsule;
use Models\Category;
use Models\City;
use Models\ExerciseType;
use Models\Post;
use Models\Role;
use Models\Training;
use Models\TrainingType;
use Models\User;
use Throwable;

class AdminController extends Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }


    public function createTraining()
    {
        $this->view->render('trainings/create', [
            'trainingTypes' => TrainingType::getOrder(),
            'exerciseTypes' => ExerciseType::getOrder(),
        ]);
    }

    public function editTraining(){
        $this->view->render('trainings/edit', [
            'trainings'=>Training::with('exercises')
                ->where('user_id', Auth::user()->id)
                ->get(),
            'trainingTypes' => TrainingType::getOrder(),
            'exerciseTypes' => ExerciseType::getOrder(),
        ]);
    }

    public function createUser()
    {
        $this->view->render('admin/users/create',[
            'roles'=>Role::get(),
            'message'=>self::getMessage()
        ]);
    }

    public function editUser()
    {
        $this->view->render('admin/users/edit',[
            'users'=>User::orderBy('name')->get(),
            'roles'=>Role::get(),
            'message'=>self::getMessage()
        ]);
    }

    public function deleteUser()
    {
        $this->view->render('admin/users/delete',[
            'users'=>User::orderBy('name')->get(),
            'message'=>self::getMessage()
        ]);
    }
}
