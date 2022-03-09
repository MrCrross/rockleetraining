<?php foreach ($users as $user):?>
<form action="/api/user/delete" method="post"
      data-name="<?php echo $user->name;?>">
    <div class="accordion m-2 rounded-2" id="accordion<?php echo $user->id; ?>">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?php echo $user->id; ?>">
                <button class="accordion-button collapsed d-flex justify-content-between p-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?php echo $user->id; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $user->id; ?>">
                    Удалить <?php echo $user->role->name."  ".$user->name; ?>
                </button>
            </h2>
            <div id="collapse<?php echo $user->id; ?>"
                 class="accordion-collapse collapse m-0"
                 aria-labelledby="heading<?php echo $user->id; ?>"
                 data-bs-parent="#accordion<?php echo $user->id; ?>">
                <div class="accordion-body">
                    <button class="btn btn-danger" type="submit">Удалить</button>
                    <div class="card p-0 my-2">
                        <div class="card-body">
                            <h5 class="card-title">
                                Фамилия
                            </h5>
                            <div class="card-text">
                                <?php echo $user->last_name; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0 my-2">
                        <div class="card-body">
                            <h5 class="card-title">
                                Имя
                            </h5>
                            <div class="card-text">
                                <?php echo $user->first_name; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="text" value="<?php echo $user->id;?>" name="id" readonly hidden/>
</form>
<?php endforeach;?>
<script>
    const forms = document.querySelectorAll('form')
    forms.forEach(function (form){
        form.addEventListener('submit',function (e){
            e.preventDefault()
            if(confirm(`Вы действительно хотите удалить пользователя ${e.target.dataset.name}?`)) form.submit()
        })
    })
</script>