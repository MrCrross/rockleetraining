<div class="d-flex justify-content-between align-items-center p-4">
    <form action="/api/user/update" method="post">
        <h3 class="h5 mb-3 fw-normal">Изменить личные данные</h3>
        <div class="form-floating my-2">
            <input type="text" class="form-control"
                   id="name" name="name"
                   value="<?php echo $user->name;?>"
                   maxlength="255" placeholder="Логин" required>
            <label for="name">Логин</label>
        </div>
        <div class="form-floating my-2">
            <input type="text" class="form-control"
                   id="last_name" name="last_name"
                   value="<?php echo $user->last_name;?>"
                   maxlength="255" placeholder="Фамилия">
            <label for="last_name">Фамилия</label>
        </div>
        <div class="form-floating my-2">
            <input type="text" class="form-control"
                   id="first_name" name="first_name"
                   value="<?php echo $user->first_name;?>"
                   maxlength="255" placeholder="Имя">
            <label for="first_name">Имя</label>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Изменить</button>
    </form>
    <form action="/api/user/changePassword" method="post">
        <h3 class="h5 mb-3 fw-normal">Изменить пароль</h3>
        <div class="form-floating my-2">
            <input type="password" class="form-control form-control-sm"
                   id="password" name="password"
                   minlength="6" maxlength="255" placeholder="Password" required>
            <label for="password">Пароль</label>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Изменить пароль</button>
    </form>
</div>