<?php

use app\models\Access;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use himiklab\sortablegrid\SortableGridView;
use app\models\Folder;

/** @var yii\web\View $this */
/** @var app\models\AccessSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$folders = Folder::getFoldersTree();

$this->title = $searchModel->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="#" class="float-right">
                    <button class="btn btn-outline-success btn-show-submenu">Скрыть панель</button>
                </a>
            </div>
        </div>

        <div class="col-md-3 column-submenu">
            <div class="card">
                <div class="card-body">
                    <?php if($folders) : ?>
                        <?php foreach($folders as $folder) : ?>
                            <ul>
                                <li>
                                    <?= $folder['name'] ?>
                                    <?php if($folder['items']) : ?>
                                        <ul>
                                            <?php foreach($folder['items'] as $folderId => $folderName) : ?>
                                                <li>
                                                    <a href="<?= Url::to(['/', 'AccessSearch[folder_id]' => $folderId]) ?>" data-folder-id="<?= $folderId ?>">
                                                        <?= $folderName ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-9 column-submenu">
            <div class="card">
                <div class="card-body">
                    <?= SortableGridView::widget([
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
                                'filter' => Folder::getFolders(),
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
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Access $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>



</div>
