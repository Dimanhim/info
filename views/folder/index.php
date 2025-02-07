<?php

use app\models\Folder;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\FolderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $searchModel->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">

    <h1><?= Html::encode($this->title) ?></h1>


        <div class="menu-items">
            <div class="row">
                <div class="col-md-6">
                    <div id="menu-items-tree" data-menu_id=""></div>
                </div>
                <div class="col-md-6">
                    <?php $form = ActiveForm::begin([
                        'id' => 'menu-item-form',
                        'action' => Url::to(['folder/create']),
                    ]); ?>
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
