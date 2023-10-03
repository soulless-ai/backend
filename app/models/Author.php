<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    // Определение таблицы, к которой относится модель
    public static function tableName()
    {
        return 'authors';
    }

    // Определение правил валидации для атрибутов модели
    public function rules()
    {
        return [
            [['name', 'birth_year', 'country'], 'required'],
            [['birth_year'], 'integer'],
            [['name', 'country'], 'string', 'max' => 255],
        ];
    }

    // Другие методы и отношения между моделями могут быть определены здесь
}
