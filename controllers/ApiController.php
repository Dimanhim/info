<?php

namespace app\controllers;

use app\models\Api;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;
use yii\filters\Cors;

/**
 *
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            /*[
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],*/
            'corsFilter' => [
                'class' => Cors::class,
            ],
        ];
    }

    public function actionIndex()
    {
//        $api = new Api('altermedica');
        $api = new Api('dima-t-main');

        return $this->render('index', [
            'api' => $api,
        ]);
    }
}
