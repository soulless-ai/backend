<?php

namespace app\controllers\api;

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Book;
use app\services\BookService;

class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    private $bookService;

    public function __construct($id, $module, BookService $bookService, $config = [])
    {
        $this->bookService = $bookService;
        parent::__construct($id, $module, $config);
    }

    public function actionGetBooks()
    {
        $searchQuery = Yii::$app->request->get('query', '');
        $searchAuthors = json_decode(Yii::$app->request->get('author', '[]'), true);
        $searchLanguages = json_decode(Yii::$app->request->get('language', '[]'), true);
        $searchGenre = json_decode(Yii::$app->request->get('genre', '[]'), true);
        $searchMinPage = Yii::$app->request->get('minPage', null);
        $searchMaxPage = Yii::$app->request->get('maxPage', null);

        $books = $this->bookService->getBooks($searchQuery, $searchAuthors, $searchLanguages, $searchGenre, $searchMinPage, $searchMaxPage);

        return $books;
    }

    public function actionGetAuthors()
    {
        $authors = $this->bookService->getDistinctAuthors();
        return $authors;
    }

    public function actionGetLanguages()
    {
        $languages = $this->bookService->getDistinctLanguages();
        return $languages;
    }

    public function actionGetGenres()
    {
        $genres = $this->bookService->getDistinctGenres();
        return $genres;
    }

    public function actionCreateBook() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $postData = Yii::$app->request->getBodyParams();
        
        Yii::$app->queue->push(new CreateBookJob([
            'postData' => $postData,
        ]));
        return ['message' => 'Creating a book is in progress.'];
    }
}