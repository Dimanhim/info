<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Folder;

/** @var yii\web\View $this */
/** @var app\models\Access $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="access-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'folder_id')->dropDownList(Folder::getFolders(), ['prompt' => '[Не выбрано]']) ?>
                    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'comment')->textarea() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?= $model->getImagesField($form) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>



</div>
