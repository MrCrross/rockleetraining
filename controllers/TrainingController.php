<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Core\View;
use Illuminate\Database\Capsule\Manager as Capsule;
use Models\Exercise;
use Models\ExerciseType;
use Models\Training;
use Models\TrainingType;
use Models\UserTraining;
use Throwable;

class TrainingController extends Controller
{

    public function index()
    {
        $this->view->render('trainings/index', [
            'trainings' => Training::with('exercises.exerciseType', 'trainingType')
                ->where('user_id', Auth::user()->id)
                ->get(),
        ]);
    }

    public function my()
    {
        $this->view->render('trainings/my', [
            'trainings' => UserTraining::with('training.exercises.exerciseType', 'training.trainingType')
                ->where('user_id', Auth::user()->id)
                ->get(),
        ]);
    }

    public function create()
    {
        $this->view->render('trainings/create', [
            'trainingTypes' => TrainingType::getOrder(),
            'exerciseTypes' => ExerciseType::getOrder(),
        ]);
    }

    public function edit()
    {
        $this->view->render('trainings/edit', [
            'trainings' => Training::with('exercises')
                ->where('user_id', Auth::user()->id)
                ->get(),
            'trainingTypes' => TrainingType::getOrder(),
            'exerciseTypes' => ExerciseType::getOrder(),
        ]);
    }

    public function insert()
    {
        $training = json_decode($_POST['training']);
        $exercises = $training->exercises;
        $name = $training->nameTraining;
        $trainingType = $training->trainingType;
        $user = $training->user;
        Capsule::beginTransaction();
        try {
            $training = Training::create([
                'name' => $name,
                'training_type_id' => $trainingType,
                'user_id' => $user
            ]);
            foreach ($exercises as $exercise) {
                $elem = json_decode($exercise);
                Exercise::create([
                    'name' => $elem->nameExercise,
                    'time' => $elem->time,
                    'description' => $elem->description,
                    'level' => $elem->level,
                    'exercise_type_id' => $elem->exerciseType,
                    'training_id' => $training->id
                ]);
            }
            Capsule::commit();
            $_SESSION['message'] = 'Новая тренировка успешно добавлен';
        } catch (Throwable $e) {
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
    }

    public function insertMy()
    {
        $id = $_POST['id'];
        $user = Auth::user()->id;
        Capsule::beginTransaction();
        try {
            UserTraining::create([
                'training_id' => $id,
                'user_id' => $user
            ]);
            Capsule::commit();
            $_SESSION['message'] = 'Тренировка добавлена в Ваши занятия.';
        } catch (Throwable $e) {
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
        View::redirect('/');
    }

    public function update()
    {
        $training = json_decode($_POST['training']);
        $exercises = $training->exercises;
        $name = $training->nameTraining;
        $trainingType = $training->trainingType;
        $id = $training->id;
        Capsule::beginTransaction();
        try {
            Training::where('id', $id)->update([
                'name' => $name,
                'training_type_id' => $trainingType,
            ]);
            Exercise::where('training_id', $id)->delete();
            foreach ($exercises as $exercise) {
                $elem = json_decode($exercise);
                Exercise::create([
                    'name' => $elem->nameExercise,
                    'time' => $elem->time,
                    'description' => $elem->description,
                    'level' => $elem->level,
                    'exercise_type_id' => $elem->exerciseType,
                    'training_id' => $training->id
                ]);
            }
            Capsule::commit();
            $_SESSION['message'] = 'Тренировка успешно изменена';
        } catch (Throwable $e) {
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        $url = '/trainings/edit';
        Capsule::beginTransaction();
        try {
            Exercise::where('training_id', $id)->delete();
            Training::where('id', $id)->delete();
            Capsule::commit();
            $_SESSION['message'] = 'Тренировка удалена.';
        } catch (Throwable $e) {
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
        View::redirect($url);
    }

    public function deleteMy()
    {
        $id = $_POST['id'];
        $user = Auth::user()->id;
        Capsule::beginTransaction();
        try {
            UserTraining::where('training_id', $id)
                ->where('user_id', $user)
                ->delete();
            Capsule::commit();
            $_SESSION['message'] = 'Тренировка удалена из Ваших занятий.';
        } catch (Throwable $e) {
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
        View::redirect($_POST['url']);
    }
}