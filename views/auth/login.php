<main class="form-signin text-center">
    <form action="/api/login" method="post">
        <img class="mb-4" src="/public/storage/images/logo.png" alt="" width="142" height="32">
        <h1 class="h3 mb-3 fw-normal">Пожалуйста, войдите</h1>
        <div class="form-floating my-2">
            <input type="text" class="form-control"
                   id="name" name="name"
                   maxlength="255" placeholder="Логин" required>
            <label for="name">Логин</label>
        </div>
        <div class="form-floating my-2">
            <input type="password" class="form-control"
                   id="password" name="password"
                   minlength="6" maxlength="255" placeholder="Password" required>
            <label for="password">Пароль</label>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Войти</button>
    </form>
</main>
