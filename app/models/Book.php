<?php

namespace app\models;

use Yii;

class Book extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['title', 'author_id', 'pages', 'description'], 'required'],
            [['pages'], 'integer'],
            [['title', 'language', 'genre_id', 'author_id', ], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'author_id' => 'ID Автора',
            'pages' => 'Количество страниц',
            'language' => 'Язык',
            'genre_id' => 'ID Жанра',
            'description' => 'Описание',
        ];
    }
}