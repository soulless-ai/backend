<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы "genre".
 *
 * @property int $id
 * @property string $name Название жанра
 *
 * @property Book[] $books Книги с этим жанром
 */
class Genre extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['genre_id' => 'id']);
    }
}
