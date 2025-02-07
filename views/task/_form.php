<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Task;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Основная информация
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'type_id')->widget(Select2::className(), [
                            'data' => Task::getTypeList(),
                            'options' => [
                                'prompt' => '[Не выбрано]',
                            ],
                        ]) ?>
                        <?= $form->field($model, 'number')->textInput() ?>
                        <?= $form->field($model, 'type_name')->textInput() ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'status_id')->widget(Select2::className(), [
                            'data' => Task::getStatusList(),
                        ]) ?>

                        <?= $form->field($model, 'price')->textInput() ?>
                        <?= $form->field($model, 'payment_date')->widget(DatePicker::className(), []) ?>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Теги
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'tags')->textarea() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?= $form->field($model, 'description')->textarea(['rows' => 24]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?= $form->field($model, 'comment')->textarea(['rows' => 24]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
