<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    // Определение таблицы, к которой относится модель
    public static function tableName()
    {
        return 'books';
    }

    // Определение правил валидации для атрибутов модели
    public function rules()
    {
        return [
            [['title', 'author', 'pageCount', 'language', 'genre', 'description'], 'required'],
            [['pageCount'], 'integer'],
            [['title', 'author', 'language', 'genre'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    // Другие методы и отношения между моделями могут быть определены здесь
}
