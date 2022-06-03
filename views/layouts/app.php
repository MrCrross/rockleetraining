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
    <title>RockLee - силовые тренировки от Рока Ли</title>
</head>
<body>
<?php

use Core\Auth;

$route = $_SERVER['REQUEST_URI'];
$auth = Auth::check();
$role = 2;
if ($auth) {
    $user = Auth::user();
    $role = $user->role_id;
}
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
        <ul class="nav col-10 col-md-auto mb-2 justify-content-center mb-md-0">
            <?php if ($auth): ?>
                <?php if ($role === 2): ?>
                    <li>
                        <a href="/trainings" class="nav-link px-2 link-light
                            <?php if ($route === '/trainings') echo $active; ?>">
                            Мои тренировки
                        </a>
                    </li>
                    <li>
                        <a href="/my_trainings" class="nav-link px-2 link-light
                            <?php if ($route === '/my_trainings') echo $active; ?>">
                            Занятия
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($role === 1): ?>
                    <li>
                        <a href="/trainings" class="nav-link px-2 link-light
                            <?php if ($route === '/trainings') echo $active; ?>">
                            Мои тренировки
                        </a>
                    </li>
                    <li>
                        <a href="/my_trainings" class="nav-link px-2 link-light
                            <?php if ($route === '/my_trainings') echo $active; ?>">
                            Занятия
                        </a>
                    </li>
                    <li>
                        <a href="/admin/users/create" class="nav-link px-2 link-light">
                            Панель администратора
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <div class="text-end">
            <?php if (!$auth): ?>
                <a href="/login" class="link-light me-2 <?php if ($route === '/login') echo $active; ?>">
                    Вход
                </a>
                <a href="/registration" class="link-light <?php if ($route === '/registration') echo $active; ?>">
                    Регистрация
                </a>
            <?php endif; ?>
            <?php if ($auth): ?>
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
            <?php endif; ?>
        </div>
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
<div class="container bg-opacity-75 bg-light rounded-2 p-2">
    <?php echo $content; ?>
</div>
<script src="/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>