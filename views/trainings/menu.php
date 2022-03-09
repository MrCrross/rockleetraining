<?php
$create = "/trainings/create";
$edit ="/trainings/edit";
if(\Core\Auth::user()->role_id === 1) {
    $create = "/admin/trainings/create";
    $edit ="/admin/trainings/edit";
}
?>

<header class="d-flex flex-wrap align-items-center justify-content-center">
    <ul class="nav justify-content-center">
        <li><a class="nav-link link-primary" href="<?php echo $create;?>">Добавить</a></li>
        <li><a class="nav-link link-info" href="<?php echo $edit;?>">Редактировать</a></li>
    </ul>
</header>

