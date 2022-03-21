<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/public/storage/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>RockLee - Панель Администратора</title>
</head>
<body>
<?php

use Core\Auth;

$route = $_SERVER['REQUEST_URI'];
$user = Auth::user();
$active = 'border-bottom border-2 pb-1 border-light';
?>
<div class="bg-body"></div>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <a href="/"
           class="<?php if ($route === '/' or strpos($route, 'types')) echo $active; ?>">
            <img src="/public/storage/images/logo.png"
                 alt="logo" width="145" height="35">
        </a>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li>
                <a href="/trainings" class="nav-link px-2 link-light
                            <?php if ($route === '/trainings') echo $active; ?>">
                    Мои тренировки
                </a>
            </li>
            <li>
                <a href="/admin/users/create" class="nav-link px-2 link-light
                    <?php if (strpos($route, 'admin')) echo $active; ?>">
                    Панель администратора
                </a>
            </li>
        </ul>
        <div class="text-end">
            <div class="dropdown">
                <a class="link-light dropdown-toggle <?php if ($route === '/lk') echo $active; ?>"
                   type="button" id="dropdownMenuButton1"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $user->name; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/lk">Личный кабинет</a></li>
                    <li>
                        <form action="/api/logout" method="post">
                            <button type="submit" class="dropdown-item">Выйти</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li class="dropdown mx-2">
                <a class="link-light dropdown-toggle <?php if (strpos($route, 'training')) echo $active; ?>"
                   type="button" id="dropdownTraining"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    Тренировки
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownTraining">
                    <li><a class="dropdown-item" href="/admin/trainings/create">Добавить</a></li>
                    <li><a class="dropdown-item" href="/admin/trainings/edit">Редактировать</a></li>
                </ul>
            </li>
            <li class="dropdown mx-2">
                <a class="link-light dropdown-toggle <?php if (strpos($route, 'users')) echo $active; ?>"
                   type="button" id="dropdownUser"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    Пользователи
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="/admin/users/create">Добавить</a></li>
                    <li><a class="dropdown-item" href="/admin/users/edit">Редактировать</a></li>
                    <li><a class="dropdown-item" href="/admin/users/delete">Удалить</a></li>
                </ul>
            </li>
        </ul>
    </header>
</div>
<?php if (isset($_SESSION['message']) and $_SESSION['message'] != ''): ?>
    <div class="position-fixed top-0 end-0 p-3">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $_SESSION['message'];
                    $_SESSION['message'] = '' ?>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="container bg-light bg-opacity-75 rounded-2 p-2">
    <?php echo $content; ?>
</div>
<script src="/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>