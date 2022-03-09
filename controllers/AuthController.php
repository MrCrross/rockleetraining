<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Illuminate\Database\Capsule\Manager as Capsule;
use Models\User;
use Throwable;

class AuthController extends Controller
{

    public function login()
    {
        $message = $this::getMessage();
        $this->view->render('auth/login',[
            'message'=>$message
        ]);
    }

    public function registration()
    {
        $message = $this::getMessage();
        $this->view->render('auth/registration',
            [
                'message'=>$message
            ]);
    }

    public function auth(){
        $login = $_POST['name'];
        $password = $_POST['password'];
        $user =User::where('name',$login)->where('password',hash('sha256',$password))->first();
        if(!is_null($user)){
            $this::session($user);
            View::redirect('/');
        }else{
            $_SESSION['message'] = 'Не верный логин или пароль';
            View::redirect('/login');
        }
    }

    public function reg(){
        if(!isset($_POST['name'])){ View::errors(403); exit;}
        $login = $_POST['name'];
        $password = $_POST['password'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $role = 2;
        Capsule::beginTransaction();
        try {
            $user = User::create([
                'name'=>$login,
                'password'=>hash('sha256',$password),
                'last_name'=>$last_name,
                'first_name'=>$first_name,
                'role_id'=>$role,
            ]);
            Capsule::commit();
            $this::session($user);
            View::redirect('/');
        }catch (Throwable $e){
            Capsule::rollback();
            $_SESSION['message'] = 'Произошла ошибка. Данные заполнены неверно.'.$e->getMessage();
            View::redirect('/registration');
        }
    }

    public function logout(){
        session_destroy();
        session_start();
        View::redirect('/');
    }

    private static function session($user){
        $_SESSION['user']=json_encode([
            'id'=>$user->id,
            'name'=>$user->name,
            'role'=>[
                'id'=>$user->role->id,
                'name'=>$user->role->name
            ]
        ]);
    }
}