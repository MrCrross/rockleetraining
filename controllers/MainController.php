<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Models\Training;
use Models\TrainingType;
use Models\User;

class MainController extends Controller
{


    public function index()
    {
        if (Auth::check())
            $this->view->render('main', [
                'trainings' => Training::with('user', 'trainingType', 'exercises.exerciseType', 'userTrainings')
                    ->orderBy('created_at')
                    ->get(),
                'types' => TrainingType::orderBy('name')->get()
            ]);
        if(!Auth::check())
            $this->view->render('main', [
                'trainings' => Training::with('user', 'trainingType', 'exercises.exerciseType')
                    ->orderBy('created_at')
                    ->get(),
                'types' => TrainingType::orderBy('name')->get()
            ]);
    }

    /**
     * Вывод объявлений только одной категории
     * Из Get получает id категории
     * Возвращает представление main с постами это категории и всеми категориями
     */
    public function view()
    {
        $type = $_GET['id'];
        $trainings = Training::with('user', 'trainingType', 'exercises.exerciseType')
            ->where('training_type_id', $type)
            ->orderBy('created_at')
            ->get();
        $this->view->render('main', [
            'trainings' => $trainings,
            'types' => TrainingType::orderBy('name')->get()
        ]);
    }

    public function lk()
    {
        if (Auth::user()->role === 1) $this->view->layout = 'admin';
        $id = Auth::user()->id;
        $this->view->render('lk', [
            'user' => User::where('id', $id)->first(),
            'message' => self::getMessage()
        ]);
    }
}