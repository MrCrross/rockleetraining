<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Models\ExerciseType;
use Throwable;
use Illuminate\Database\Capsule\Manager as Capsule;

class ExerciseTypeController extends Controller
{

    public function insert(){
        $name = $_POST['name'];
        Capsule::beginTransaction();
        try{
            ExerciseType::create([
                'name'=>$name
            ]);
            Capsule::commit();
            $_SESSION['message'] = 'Новый вид упражнений успешно добавлен';
        }catch (Throwable $e){
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
        View::redirect('/admin/trainings/create');
    }

    public function update(){
        if (!isset($_POST['id'])) {
            View::errors(404);
            exit;
        }
        $id = $_POST['id'];
        $name = $_POST['name'];
        Capsule::beginTransaction();
        try{
            ExerciseType::where('id',$id)->update([
                'name'=>$name
            ]);
            Capsule::commit();
            $_SESSION['message'] = 'Вид упражнений успешно изменен';
        }catch (Throwable $e){
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
        }
        View::redirect('/admin/trainings/edit');
    }

    public function delete(){
        $id = $_POST['id'];
        Capsule::beginTransaction();
        try{
            ExerciseType::where('id',$id)->delete();
            Capsule::commit();
            $_SESSION['message'] = 'Вид упражнений успешно удален';
        }catch (Throwable $e){
            Capsule::rollBack();
            $_SESSION['message'] = 'Ошибка:' . $e->getMessage();
            if ($e->getCode()==='23000') $_SESSION['message'] = 'Невозможно удалить. Некоторые упражнения относятся к этому виду.';

        }
        View::redirect('/admin/trainings/edit');
    }

}