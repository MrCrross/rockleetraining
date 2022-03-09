<?php use Core\Auth;

require_once 'menu.php'; ?>
<div class="w-100 text-center p-1">
    <h3 class="h5 fw-normal">Редактирование комплексов тренировок</h3>
</div>
<?php if (Auth::user()->role_id == 1): ?>
    <div class="w-100 text-center p-1">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exerciseTypesUpdate">
            Изменение видов упражнений
        </button>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#trainingTypesUpdate">
            Изменение видов тренировок
        </button>
    </div>
    <div class="w-100 text-center p-1">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exerciseTypesDelete">
            Удаление видов упражнений
        </button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#trainingTypesDelete">
            Удаление видов тренировок
        </button>
    </div>
<?php endif; ?>
<?php if (isset($trainings) and count($trainings) !== 0): ?>
    <?php foreach ($trainings as $training): ?>
        <form class="updateTraining mb-3" action="/api/trainings/update" method="post">
            <div class="d-flex align-items-top justify-content-between mb-2">
                <div class="w-25 me-2">
                    <header class="d-flex align-items-center mb-2">
                        <button type="button" class="deleteTraining btn btn-danger" data-id="<?php echo $training->id; ?>" title="Удалить тренировку">-</button>
                    </header>
                    <div class="form-floating mb-2">
                        <select class="form-control" name="trainingType" required>
                            <?php foreach ($trainingTypes as $type): ?>
                                <option value="<?php echo $type->id; ?>"
                                    <?php if ($type->id === $training->training_type_id) echo 'selected'; ?>>
                                    <?php echo $type->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="trainingType">Тип тренировки</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="text" class="form-control" value="<?php echo $training->id; ?>" name="id" readonly
                               hidden required>
                        <input type="text" class="form-control"
                               name="nameTraining"
                               value="<?php echo $training->name; ?>"
                               maxlength="255" placeholder="Название тренировки" required>
                        <label for="nameTraining">Название тренировки</label>
                    </div>
                </div>
                <div class="w-75 ">
                    <header class="d-flex align-items-center ">
                        <button type="button" id="newExercise" class="btn btn-success" title="Добавить упражнение">+</button>
                    </header>
                    <div class="workspace">
                        <?php foreach ($training->exercises as $exercise): ?>
                            <div class="accordion rounded-2 my-2" id="accordion<?php echo $exercise->id; ?>">
                                <div class="accordion-item">
                                    <h2 class="accordion-header text-center" id="heading<?php echo $exercise->id; ?>">
                                        <div class="input-group">
                                            <input type="number" class="form-control w-6" min="0" name="level"
                                                   value="<?php echo $exercise->level ?>" required>
                                            <button class="accordion-button form-control bg-light text-dark fw-bold"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?php echo $exercise->id; ?>"
                                                    aria-expanded="true" aria-controls="collapse">
                                                <?php echo $exercise->level ?> упражнение
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger input-group-text"
                                                    title="Удалить упражнение">-
                                            </button>
                                        </div>
                                    </h2>
                                    <div id="collapse<?php echo $exercise->id; ?>"
                                         class="accordion-collapse collapse show"
                                         aria-labelledby="heading"
                                         data-bs-parent="#accordion<?php echo $exercise->id; ?>">
                                        <div class="card rounded-0 border-0">
                                            <div class="card-body">
                                                <div class="form-floating my-2">
                                                    <select class="form-control" name="exerciseTypes" required>
                                                        <?php foreach ($exerciseTypes as $type): ?>
                                                            <option value="<?php echo $type->id; ?>"
                                                                <?php if ($type->id === $exercise->exercise_type_id) echo 'selected'; ?>>
                                                                <?php echo $type->name; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label for="exerciseTypes">Тип упражнения</label>
                                                </div>
                                                <div class="form-floating my-2">
                                                    <input type="text" class="form-control"
                                                           name="nameExercise"
                                                           value="<?php echo $exercise->name; ?>"
                                                           maxlength="255" placeholder="Название упражнения" required>
                                                    <label for="nameExercise">Название тренировки</label>
                                                </div>
                                                <div class="form-floating my-2">
                                                    <input type="number" class="form-control"
                                                           name="time" min="0" max="300" step="5"
                                                           value="<?php echo $exercise->time; ?>"
                                                           placeholder="Длительность упражнения" required>
                                                    <label for="time">Длительность упражнения в секундах</label>
                                                </div>
                                                <div class="my-2">
                                                    <label for="description">Описание упражнения</label>
                                                    <textarea class="form-control" name="description"
                                                              rows="5" placeholder="Описание упражнения"
                                                              required><?php echo $exercise->description; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <button class="w-100 btn btn-primary" type="submit">Сохранить</button>
        </form>
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-center w-100">
        <h5 class="h5 mb-2">Вы не разрабатывали тренировок</h5>
        <a href="/trainings/create" class="btn btn-primary">Добавить</a>
    </div>
<?php endif; ?>


<div id="template" class="visually-hidden">
    <div class="accordion rounded-2 my-2" id="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header text-center" id="heading">
                <div class="input-group">
                    <input type="number" class="form-control w-6" min="0" name="level" required>
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
    <div class="modal fade" id="exerciseTypesUpdate" tabindex="-1" aria-labelledby="exerciseTypesUpdateLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exerciseTypesUpdateLabel">Изменение типа упражнений</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/exercise/update" method="post">
                    <div class="modal-body">
                        <div class="form-floating my-2">
                            <select class="form-control" name="id" required>
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
                                   name="name"
                                   maxlength="255" placeholder="Название упражнения" required>
                            <label for="nameExercise">Новое название упражнения</label>
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

    <div class="modal fade" id="trainingTypesUpdate" tabindex="-1" aria-labelledby="trainingTypesUpdateLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingTypesUpdateLabel">Изменение типа тренировок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/training/update" method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <select class="form-control" name="id" required>
                                <?php foreach ($trainingTypes as $type): ?>
                                    <option value="<?php echo $type->id; ?>"
                                        <?php if ($type->id === $training->training_type_id) echo 'selected'; ?>>
                                        <?php echo $type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id">Тип тренировки</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="text" class="form-control"
                                   name="name"
                                   maxlength="255" placeholder="Название тренировки" required>
                            <label for="name">Новое название тренировки</label>
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
    <div class="modal fade" id="exerciseTypesDelete" tabindex="-1" aria-labelledby="exerciseTypesDeleteLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exerciseTypesDeleteLabel">Удаление типа упражнений</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/exercise/delete" method="post">
                    <div class="modal-body">
                        <div class="form-floating my-2">
                            <select class="form-control" name="id" required>
                                <?php foreach ($exerciseTypes as $type): ?>
                                    <option value="<?php echo $type->id; ?>">
                                        <?php echo $type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="exerciseTypes">Удаляемое упражнение</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="trainingTypesDelete" tabindex="-1" aria-labelledby="trainingTypesDeleteLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingTypesDeleteLabel">Удаление типа тренировок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/types/training/delete" method="post">
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <select class="form-control" name="id" required>
                                <?php foreach ($trainingTypes as $type): ?>
                                    <option value="<?php echo $type->id; ?>"
                                        <?php if ($type->id === $training->training_type_id) echo 'selected'; ?>>
                                        <?php echo $type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id">Удаляемая тренировка</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="/public/js/trainings.js"></script>