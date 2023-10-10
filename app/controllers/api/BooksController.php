<?php

namespace app\controllers\api;

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Book;

class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }    
    public function actionIndex() {
        Yii::$app->response->format = Response::FORMAT_JSON;
    
        $books = Book::find()->all();
    
        return $books;
    }
    
    public function actionGetBooks() {
        Yii::$app->response->format = Response::FORMAT_JSON;
    
        $searchQuery = Yii::$app->request->get('searchQuery', '');
        $searchAuthors = Yii::$app->request->get('searchAuthors', '');
        $searchLanguages = Yii::$app->request->get('searchLanguages', '');
    
        $query = Book::find();
    
        if (!empty($searchQuery)) {
            $query->andWhere(['OR', 
                ['ILIKE', 'title', $searchQuery],
                ['ILIKE', 'description', $searchQuery]
            ]);
        }
    
        if (!empty($searchAuthors)) {
            $authorsArray = explode(',', $searchAuthors);
            $query->andWhere(['IN', 'author_id', $authorsArray]);
        }
    
        if (!empty($searchLanguages)) {
            $languagesArray = explode(',', $searchLanguages);
            $query->andWhere(['IN', 'language', $languagesArray]);
        }
    
        $books = $query->all();
    
        return $books;
    }
    
    public function actionGetAuthors() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $authors = Book::find()->select(['author_id'])->distinct()->asArray()->all();
        
        $authorValues = array_column($authors, 'author_id');
        
        return $authorValues;
    }
    public function actionGetLanguages() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $languages = Book::find()->select(['language'])->distinct()->asArray()->all();
        
        $languageValues = array_column($languages, 'language');
        
        return $languageValues;
    }
    public function actionGetGenres() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $genres = Book::find()->select(['genre'])->distinct()->asArray()->all();
        
        $genreValues = array_column($genres, 'genre');
        
        return $genreValues;
    }
    
    public function actionCreateBook() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $postData = Yii::$app->request->getBodyParams();

        $book = new Book();
        $book->load($postData, '');
        
        if ($book->save()) {
            return $book;
        } else {
            return ['error' => 'Unable to create the book.', 'errors' => $book->getErrors()];
        }
    }
}