<?php use Core\Auth;
$route = $_SERVER['REQUEST_URI']; ?>
<div class="d-flex">
    <div class="w-25 m-4">
        <div class="my-2 h5">Сложности:</div>
        <ul class="list-group rounded-2">
            <a href="/">
                <li class="list-group-item rounded-top <?php if ($route === '/') echo 'active'; ?>">
                    1. Все
                </li>
            </a>
            <?php if (!empty($types) and count($types)): ?>
                <?php foreach ($types as $key => $type): ?>
                    <a href="/types/type<?php echo $type->id; ?>">
                        <li class="list-group-item
                        <?php
                        if ($route === '/types/type' . $type->id) echo 'active';
                        if ($key === count($types) - 1) echo 'rounded-bottom';
                        ?>">
                            <?php echo strval($key + 2) . '. ' . $type->name; ?>
                        </li>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="w-100 my-4">
        <?php if (!empty($trainings) and count($trainings) !== 0): ?>
            <?php foreach ($trainings as $training): ?>
                <div class="accordion m-2 rounded-2" id="accordion<?php echo $training->id; ?>">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $training->id; ?>">
                            <div class="input-group">
                                <button class="accordion-button form-control collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo $training->id; ?>"
                                        aria-expanded="true" aria-controls="collapse">
                                    <?php if ($route === '/') echo $training->trainingType->name . ': '; ?>
                                    <?php echo $training->name; ?>
                                </button>
                                <?php if (Auth::check() and count($training->userTrainings)===0): ?>
                                    <form action="/api/trainings/insertMy" method="post" class="d-flex">
                                        <input type="text" name="id" value="<?php echo $training->id; ?>" readonly
                                               hidden>
                                        <button type="submit" class="btn btn-sm btn-light input-group-text"
                                                title="Добавить в свои занятия">+
                                        </button>
                                    </form>
                                <?php elseif(Auth::check() and count($training->userTrainings)!==0): ?>
                                    <form action="/api/trainings/deleteMy" method="post" class="d-flex">
                                        <input type="text" name="id" value="<?php echo $training->id; ?>" readonly
                                               hidden>
                                        <input type="text" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" readonly
                                               hidden>
                                        <button type="submit" class="btn btn-sm btn-success input-group-text"
                                                title="У вас есть в занятиях эта тренировка">&#10003;
                                        </button>
                                    </form>
                                <?php elseif(!Auth::check()):?>
                                    <a href="/login" type="button" class="btn btn-sm btn-light d-flex align-items-center input-group-text"
                                            title="Добавить в свои занятия">+
                                    </a>
                                <?php endif; ?>
                            </div>
                        </h2>
                        <?php foreach ($training->exercises as $key => $exercise): ?>
                            <div id="collapse<?php echo $training->id; ?>"
                                 class="accordion-collapse collapse m-0"
                                 aria-labelledby="heading"
                                 data-bs-parent="#accordion<?php echo $training->id; ?>">
                                <div class="accordion-body">
                                    <div class="card p-0 m-0">
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
            <div class="container_fluid">
                <div class="flex-center">
                    Тренировок пока нет. Извините за предоставленные не удобства.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
