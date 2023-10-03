<?php

namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use app\models\Genre; // Подключаем модель жанра
use yii\web\Response;

class GenreController extends ActiveController
{
    public $modelClass = 'app\models\Genre';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    // Действие для получения списка жанров
    public function actionIndex()
    {
        $genres = Genre::find()->all();
        return $genres;
    }

    // Действие для создания нового жанра
    public function actionCreate()
    {
        $model = new Genre();
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save()) {
            return $model;
        } else {
            return $model->getErrors();
        }
    }

    // Действие для получения данных о жанре по ID
    public function actionView($id)
    {
        $genre = Genre::findOne($id);
        if ($genre === null) {
            throw new NotFoundHttpException("Жанр с ID $id не найден.");
        }
        return $genre;
    }

    // Действие для обновления данных о жанре по ID
    public function actionUpdate($id)
    {
        $model = Genre::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Жанр с ID $id не найден.");
        }

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save()) {
            return $model;
        } else {
            return $model->getErrors();
        }
    }

    // Действие для удаления жанра по ID
    public function actionDelete($id)
    {
        $model = Genre::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Жанр с ID $id не найден.");
        }

        if ($model->delete()) {
            return 'Жанр успешно удален.';
        } else {
            return 'Произошла ошибка при удалении жанра.';
        }
    }
}
