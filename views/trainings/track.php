<div class="bg-white rounded-2 m-2">
    <div class="p-3">
        <h3 class="training border-bottom" data-id="<?php echo $training->id; ?>">
            <?php echo $training->name; ?>
            <a id="start" type="button" title="Начать"
                                              class="btn btn-outline-success p-1">Начать</a>
        </h3>
        <ul class="list-unstyled mt-2">
            <?php foreach ($training->exercises as $key => $exercise): ?>
                <li>
                    <div class="d-flex justify-content-between exercise visually-hidden"
                         data-id="<?php echo $exercise->id; ?>">
                        <span class="name fw-bold">
                            <?php echo $exercise->name; ?>
                        </span>
                        <button type="button" title="Приступить"
                                class="timer btn btn-outline-secondary p-1"><?php echo $exercise->time; ?></button>
                    </div>
                </li>
            <?php endforeach; ?>
            <li>
                <div id="end" class="d-flex justify-content-center align-items-center  visually-hidden"></div>
            </li>
        </ul>
    </div>
</div>

<div class="accordion m-2 rounded-2" id="accordion<?php echo $training->id; ?>">
    <div class="accordion-item">
        <h2 class="accordion-header text-center" id="heading<?php echo $training->id; ?>">
            <div class="input-group">
                <button class="accordion-button form-control bg-light text-dark fw-bold" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse<?php echo $training->id; ?>"
                        aria-expanded="true" aria-controls="collapse<?php echo $training->id; ?>">
                    <?php echo $training->trainingType->name . ': ' . $training->name; ?>
                </button>
            </div>
        </h2>
        <?php foreach ($training->exercises as $key => $exercise): ?>
            <div id="collapse<?php echo $training->id; ?>"
                 class="accordion-collapse collapse show"
                 aria-labelledby="heading<?php echo $training->id; ?>"
                 data-bs-parent="#accordion<?php echo $training->id; ?>">
                <div class="accordion-body p-0 m-0">
                    <div class="card rounded-0 border-0 border-bottom">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo ++$key . '. ' . $exercise->name; ?>
                            </h5>
                            <div class="card-text">
                                <?php echo $exercise->description; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const training = document.querySelector('.training')
        const trainingId = training.dataset.id
        if (localStorage.getItem(`trackExercise${trainingId}`) === null) {
            const exercise = document.querySelector('.exercise')
            const id = exercise.dataset.id
            localStorage.setItem(`trackExercise${trainingId}`, id)
        }

        function checkNext() {
        }

        function startTimer(e) {
            e.setAttribute('disabled', 'disabled')
            setTimeout(() => timer(e), 1000)
        }


        function timer(e) {
            const time = parseInt(e.innerHTML)
            if (time === 0) {
                next(e);
                return
            }
            e.innerHTML = time - 50
            setTimeout(() => timer(e), 2000)
        }

        function next(e) {
            const li = e.parentElement.parentElement.nextSibling.nextSibling
                e.parentElement.classList.add('visually-hidden')
            if(li.querySelector('.exercise')){
                li.querySelector('.exercise').classList.remove('visually-hidden')
            }else{
                end(trainingId)
            }
        }

        function end(id) {
            const formData = new FormData;
            formData.set('id', id);

            fetch('/api/execution', {
                method: 'post',
                credentials: 'same-origin',
                body: formData
            })
                .then(res=>res.json())
                .then((res) =>{
                    document.getElementById('end').classList.remove('visually-hidden')
                    document.getElementById('end').innerText=res.message
                    document.getElementById('start').classList.add('visually-hidden')
                })
        }

        function start() {
            const id = localStorage.getItem(`trackExercise${trainingId}`)
            if (id) {
                document.querySelector(`.exercise[data-id="${id}"]`).classList.remove('visually-hidden')
            }
        }

        document.getElementById('start').addEventListener('click', (e) => {
            start();
        })
        document.querySelectorAll('.timer').forEach((e) => {
            e.addEventListener('click', (e) => {
                startTimer(e.target);
            })
        })
        // document.getElementById('end').addEventListener('click',(e)=>{
        //     end();
        // })

    })
</script>