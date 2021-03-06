<?php require_once 'menu.php';?>
<?php if (isset($trainings) and count($trainings) !== 0): ?>
    <?php foreach ($trainings as $training): ?>
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
                        <form action="/api/trainings/delete" method="post" class="d-flex">
                            <input type="text" name="id" value="<?php echo $training->id; ?>" readonly
                                   hidden>
                            <button type="submit" class="btn btn-sm btn-danger input-group-text"
                                    title="Удалить тренировку">-
                            </button>
                        </form>
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
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-center w-100">
        <h5 class="h5 mb-2">Вы не разрабатывали тренировок</h5>
        <a href="/trainings/create" class="btn btn-primary">Добавить</a>
    </div>
<?php endif; ?>