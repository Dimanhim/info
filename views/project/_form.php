<?php

use app\models\Task;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Folder;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

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
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'folder_id')->dropDownList(Folder::getFolders(), ['prompt' => '[Не выбрано]']) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
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
