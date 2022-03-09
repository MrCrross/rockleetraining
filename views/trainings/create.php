<?php require_once 'menu.php'; ?>
<div class="w-100 text-center p-1">
    <?php use Core\Auth; ?>
    <h3 class="h5 fw-normal">Создание нового комплекса тренировок</h3>
</div>
<?php if (Auth::user()->role_id == 1): ?>
    <div class="w-100 text-center p-1">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exerciseTypesCreate">
            Добавить вид упражнений
        </button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#trainingTypesCreate">
            Добавить вид тренировок
        </button>
    </div>
<?php endif; ?>
<form id="createTraining" action="/api/trainings/insert" method="post">
    <div class="d-flex align-items-top justify-content-between mb-2">
        <div class="w-25 me-2">
            <div class="form-floating mb-2">
                <select class="form-control" name="trainingType" required>
                    <?php foreach ($trainingTypes as $type): ?>
                        <option value="<?php echo $type->id; ?>">
                            <?php echo $type->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="trainingType">Тип тренировки</label>
            </div>
            <div class="form-floating my-2">
                <input type="text" class="form-control" value="<?php echo Auth::user()->id; ?>" name="user" readonly
                       hidden required>
                <input type="text" class="form-control"
                       name="nameTraining"
                       maxlength="255" placeholder="Название тренировки" required>
                <label for="nameTraining">Название тренировки</label>
            </div>
        </div>
        <div class="w-75 ">
            <header class="d-flex align-items-center ">
                <button type="button" id="newExercise" class="btn btn-success" title="Добавить упражнение">+</button>
            </header>
            <div class="workspace">
                <div class="accordion rounded-2 my-2" id="accordion1">
                    <div class="accordion-item">
                        <h2 class="accordion-header text-center" id="heading1">
                            <div class="input-group">
                                <input type="text" name="level" value="1" readonly required hidden>
                                <button class="accordion-button form-control bg-light text-dark fw-bold" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse1"
                                        aria-expanded="true" aria-controls="collapse">
                                    1 упражнение
                                </button>
                            </div>
                        </h2>
                        <div id="collapse1"
                             class="accordion-collapse collapse show"
                             aria-labelledby="heading"
                             data-bs-parent="#accordion1">
                            <div class="card rounded-0 border-0">
                                <div class="card-body">
                                    <div class="form-floating my-2">
                                        <select class="form-control" name="exerciseTypes" required>
                                            <?php foreach ($exerciseTypes as $type): ?>
                                                <option value="<?php echo $type->id; ?>">
                                                    <?php echo $type->name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="exerciseTypes">Тип упражнения</label>
                                    </div>
                                    <div class="form-floating my-2">
                                        <input type="text" class="form-control"
                                               name="nameExercise"
                                               maxlength="255" placeholder="Название упражнения" required>
                                        <label for="nameExercise">Название тренировки</label>
                                    </div>
                                    <div class="form-floating my-2">
                                        <input type="number" class="form-control"
                                               name="time" min="0" max="300" step="5" value="30"
                                               placeholder="Длительность упражнения" required>
                                        <label for="time">Длительность упражнения в секундах</label>
                                    </div>
                                    <div class="my-2">
                                        <label for="description">Описание упражнения</label>
                                        <textarea class="form-control" name="description"
                                                  rows="5" placeholder="Описание упражнения" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="w-100 btn btn-primary" type="submit">Сохранить</button>
</form>

<div id="template" class="visually-hidden">
    <div class="accordion rounded-2 my-2" id="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header text-center" id="heading">
                <div class="input-group">
                    <input type="text" name="level" readonly required hidden>
                    <button class="accordion-button collapsed form-control bg-light text-dark fw-bold" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse"
                            aria-expanded="true" aria-controls="collapse">
                    </button>
                    <button type="button" class="btn btn-sm btn-danger input-group-text"
                            title="Удалить упражнение">-
                    </button>
                </div>
            </h2>
            <div id="collapse"
                 class="accordion-collapse collapse"
                 aria-labelledby="heading"
                 data-bs-parent="#accordion">
                <div class="card">
                    <div class="card-body">
                        <div class="form-floating my-2">
                            <select class="form-control" name="exerciseTypes" required>
                                <?php foreach ($exerciseTypes as $type): ?>
                                    <option value="<?php echo $type->id; ?>">
                                        <?php echo $type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="exerciseTypes">Тип упражнения</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="text" class="form-control"
                                   name="nameExercise"
                                   maxlength="255" placeholder="Название упражнения" required>
                            <label for="nameExercise">Название тренировки</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="number" class="form-control"
                                   name="time" min="0" max="300" step="5" value="30"
                                   placeholder="Длительность упражнения" required>
                            <label for="time">Длительность упражнения в секундах</label>
                        </div>
                        <div class="my-2">
                            <label for="description">Описание упражнения</label>
                            <textarea class="form-control" name="description"
                                      rows="5" placeholder="Описание упражнения" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (Auth::user()->role_id === 1): ?>
    <div class="modal fade" id="exerciseTypesCreate" tabindex="-1" aria-labelledby="exerciseTypesCreateLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exerciseTypesCreateLabel">Добавление нового типа упражнений</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/exercise/insert" method="post">
                    <div class="modal-body">
                        <div class="form-floating my-2">
                            <input type="text" class="form-control"
                                   name="name"
                                   maxlength="255" placeholder="Название упражнения" required>
                            <label for="nameExercise">Название упражнения</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="trainingTypesCreate" tabindex="-1" aria-labelledby="trainingTypesCreateLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingTypesCreateLabel">Добавление нового типа тренировок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/training/insert" method="post">
                    <div class="modal-body">
                        <div class="form-floating my-2">
                            <input type="text" class="form-control"
                                   name="name"
                                   maxlength="255" placeholder="Название тренировки" required>
                            <label for="nameExercise">Название тренировки</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="/public/js/trainings.js"></script>