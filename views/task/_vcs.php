<?php

use yii\helpers\Html;

?>
<table class="table">
    <tr>
        <th>Проект</th>
        <th>Ветка</th>
        <th>Действие</th>
    </tr>
    <tr>
        <td>sandbox.rnova.org</td>
        <td>task/55555</td>
        <td>create from release/production</td>
    </tr>
    <tr>
        <td>sandbox.rnova.org</td>
        <td>task/55555</td>
        <td>commit</td>
    </tr>
    <tr>
        <td>sandbox.rnova.org</td>
        <td>task/55555</td>
        <td>push</td>
    </tr>
    <tr>
        <td>sandbox.rnova.org</td>
        <td>task/55555</td>
        <td>merge to release/production</td>
    </tr>
    <tr>
        <td>sandbox.rnova.org</td>
        <td>release/production</td>
        <td>push</td>
    </tr>
</table>

<div id="vcs-form">
    <div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Проект</label>
                    <select class="form-control vcs-select-project-o">
                        <option value="">[Не выбран]</option>
                        <option value="1">rnova.ru</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Ветка</label>
                    <select class="form-control vcs-select-branch-o">
                        <option value="">[Не выбрана]</option>
                        <option value="1">task/55555</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Действие</label>
                    <select class="form-control vcs-select-action-o">
                        <option value="">[Не выбрано]</option>
                        <option value="1">commit</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Направление</label>
                    <select class="form-control vcs-select-direction-o">
                        <option value="">[Не выбрано]</option>
                        <option value="1">от</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Ветка действия</label>
                    <select class="form-control vcs-select-action-branch-o">
                        <option value="">[Не выбрана]</option>
                        <option value="1">release/production</option>
                    </select>
                </div>
            </div>
        </div>
        <?= Html::a('Добавить', ['#'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>
</div>
