<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\Task;
use kartik\widgets\DatePicker;
use app\models\Project;
use yii\grid\GridView;

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
                        <?= $form->field($model, 'project_id')->dropDownList(Project::getList(), ['prompt' => '[Не выбрано]']) ?>
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
        <?php if($dataProvider && $searchModel) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-icon-o">
                            <div>Доступы</div>
                            <div style="margin-left:auto">
                                <i class="bi bi-arrow-down"></i>
                            </div>
                        </div>
                        <div class="card-body card-body-access card-body-access-o">

                            <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            'name',
                                            [
                                                    'attribute' => 'folder_id',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        if($folder = $data->folder) {
                                                            return Html::a($data->fullName, ['folder/view', 'id' => $folder->id]);
                                                        }
                                                    },
                                                    'filter' => false,
                                            ],
                                            [
                                                    'attribute' => 'login',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        return $data->getCopyLink('login');
                                                    }
                                            ],
                                            [
                                                    'attribute' => 'password',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        return $data->getCopyLink('password', true);
                                                    }
                                            ],
                                            [
                                                    'attribute' => 'url',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        return $data->getCopyLink('url');
                                                    }
                                            ],
                                            [
                                                    'attribute' => 'host',
                                                    'format' => 'raw',
                                                    'value' => function($data) {
                                                        return $data->getCopyLink('host');
                                                    }
                                            ],
                                            'comment',

                                    ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

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
