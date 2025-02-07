<?php

namespace app\controllers;

use app\controllers\AjaxBaseController;
use app\models\Folder;
use app\models\Task;
use common\models\MenuItem;
use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AjaxController extends AjaxBaseController
{

    /**
     * @param int $menuId
     * @return array
     */
    public function actionGetTreeChildren() {
        $result = [];

        foreach (Folder::find()->where(['parent_id' => 0])->orderBy('position ASC')->all() as $item) {
            $result = $this->prepareMenuItem($item, $result);
        }
        return $result;
    }

    /**
     * @param MenuItem $menuItem
     * @param array $result
     * @return array
     */
    private function prepareMenuItem($item, $result = []) {
        $isDirectory = count($item->children) > 0;
        $result[] = [
            'id' => $item->id,
            'parent' => $item->parent_id ? $item->parent_id : '#',
            'text' => $item->name,
            'children' => $isDirectory ? [] : false,
            'icon' => $isDirectory ? '' : 'glyphicon glyphicon-file',
            'state' => [
                'opened' => true,
            ],
        ];
        foreach ($item->children as $subItem) {
            $result = $this->prepareMenuItem($subItem, $result);
        }
        return $result;
    }

    /**
     *
     */
    public function actionMoveItems() {
        $items = Yii::$app->request->post('data');
        foreach ($items as $item) {
            $menuItem = Folder::findOne($item['id']);
            if (!$menuItem) {
                continue;
            }

            $menuItem->parent_id = $item['parent_id'];
            $menuItem->position = $item['position'];
            $menuItem->save();
        }
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionRemoveMenuItem($id) {
        $item = Folder::findOne($id);
        if ($item) {
            $item->delete();
        }
    }

    /**
     * Updates an existing MenuItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdateMenuItem($id)
    {
        $model = Folder::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['folder/index']);
        }

        return $this->render('//folder/update', [
            'model' => $model,
        ]);
    }

    public function actionChangeTaskStatus()
    {
        $taskId = Yii::$app->request->post('task_id');
        $statusId = Yii::$app->request->post('status_id');

        if($task = Task::findOne($taskId)) {
            $task->status_id = $statusId;
            if($task->save()) {
                return $this->response();
            }
        }
        $this->_addError('Не удалось сохранить статус');
        return $this->response();
    }

}

