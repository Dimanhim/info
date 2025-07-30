<?php

use yii\helpers\Html;

?>
<div class="row" style="">
    <div style="width: auto;">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success pull-left']) ?>
        <?= Html::a('Активные Rnova', ['status' => 'custom-active-rnova'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Активные Разраб', ['status' => 'custom-active-dev'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('За неделю', ['status' => 'custom-done'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('В работе', ['status' => 'custom-proccess'], ['class' => 'btn btn-warning']) ?>
    </div>
</div>

