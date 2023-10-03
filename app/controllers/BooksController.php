<?php

namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['http://localhost:4200'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
            ],
        ];
        return $behaviors;
    }    
    
    public function actionGetBooks() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Получаем параметры запроса
        $searchQuery = Yii::$app->request->get('searchQuery');
        $authors = Yii::$app->request->get('authors');
        $languages = Yii::$app->request->get('languages');
        $pages = Yii::$app->request->get('pages');
        $genre = Yii::$app->request->get('genre');

        // Выполняем логику для фильтрации книг и возвращаем результат
        $books = YourBookModel::find()
            ->andFilterWhere(['like', 'title', $searchQuery])
            ->andFilterWhere(['in', 'author_id', explode(',', $authors)])
            ->andFilterWhere(['in', 'language', explode(',', $languages)])
            ->andFilterWhere(['in', 'pages', explode(',', $pages)])
            ->andFilterWhere(['genre' => $genre])
            ->all();

        return $books;
    }
}