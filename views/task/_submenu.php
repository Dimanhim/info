<?php

use yii\helpers\Html;

?>
<div class="row" style="">
    <div style="width: auto;">
        <?= Html::a('Добавить', ['task/create'], ['class' => 'btn btn-success pull-left']) ?>
        <?= Html::a('Активные Rnova', ['task/index', 'status' => 'custom-active-rnova'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Активные Разраб', ['task/index', 'status' => 'custom-active-dev'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('За неделю', ['task/index', 'status' => 'custom-done'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('В работе', ['task/index', 'status' => 'custom-proccess'], ['class' => 'btn btn-warning']) ?>
    </div>
</div>

