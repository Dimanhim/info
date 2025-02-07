<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DevInfo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dev-info-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Основная информация
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'description')->textarea(['cols' => 10, 'rows' => 10, 'maxlength' => true]) ?>

                        <?= $form->field($model, 'text')->textarea(['cols' => 10, 'rows' => 10, 'maxlength' => true]) ?>

                        <?= $form->field($model, 'is_active')->checkbox() ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?= $model->getImagesField($form) ?>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

    </div>
    <?php ActiveForm::end(); ?>








</div>
