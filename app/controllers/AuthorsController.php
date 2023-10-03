<?php

namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use app\models\Author; // Подключаем модель автора
use yii\web\Response;

class AuthorController extends ActiveController
{
    public $modelClass = 'app\models\Author';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    // Действие для получения списка авторов
    public function actionIndex()
    {
        $authors = Author::find()->all();
        return $authors;
    }

    // Действие для создания нового автора
    public function actionCreate()
    {
        $model = new Author();
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save()) {
            return $model;
        } else {
            return $model->getErrors();
        }
    }

    // Действие для получения данных об авторе по ID
    public function actionView($id)
    {
        $author = Author::findOne($id);
        if ($author === null) {
            throw new NotFoundHttpException("Автор с ID $id не найден.");
        }
        return $author;
    }

    // Действие для обновления данных об авторе по ID
    public function actionUpdate($id)
    {
        $model = Author::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Автор с ID $id не найден.");
        }

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save()) {
            return $model;
        } else {
            return $model->getErrors();
        }
    }
}
