<table class="table">
    <thead>
    <tr>
        <th scope="col">Тренировка</th>
        <th scope="col">Дата прохождения</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($trainings as $training):?>
    <tr>
        <td><?php echo $training->training->name;?></td>
        <td><?php echo $training->execution;?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>