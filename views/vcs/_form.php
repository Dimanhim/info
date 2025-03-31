<?php

use app\models\Project;
use app\models\Vcs;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Vcs $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vcs-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Основная информация
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'project_id')->widget(Select2::className(), [
                            'data' => Project::getList(),
                            'options' => [
                                'prompt' => '[Не выбрано]',
                            ],
                        ]) ?>
                        <?= $form->field($model, 'branch')->textInput() ?>

                        <?= $form->field($model, 'parent_branch_id')->widget(Select2::className(), [
                            'data' => Vcs::getList(),
                            'options' => [
                                'prompt' => '[Не выбрано]',
                            ],
                        ]) ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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
