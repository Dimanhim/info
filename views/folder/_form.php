<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Folder;

/** @var yii\web\View $this */
/** @var app\models\Folder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="folder-form">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'parent_id')->dropDownList(Folder::getMainFolderList(), ['prompt' => '[Не выбрано]']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>



</div>
