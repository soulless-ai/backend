<?php

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use app\models\Book;

class CreateBookJob extends BaseObject implements JobInterface {
    public $postData;

    public function execute($queue) {
        $book = new Book();
        $book->load($this->postData, '');
        
        if (!$book->save()) {
            Yii::error('Failed to create a book: ' . json_encode($book->getErrors()));
            throw new ServerErrorHttpException('Unable to create the book.');
        }
    }
}