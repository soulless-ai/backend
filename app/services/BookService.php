<?php

namespace app\services;

use app\models\Book;
use yii\db\Query;

class BookService
{
    public function getBooks($searchQuery, $searchAuthors, $searchLanguages, $searchGenre, $searchMinPage, $searchMaxPage)
    {
        $query = $this->buildQuery($searchQuery, $searchAuthors, $searchLanguages, $searchGenre, $searchMinPage, $searchMaxPage);
        return $query->all();
    }

    public function getDistinctAuthors()
    {
        return (new Query())
            ->select(['author_id'])
            ->from(Book::tableName())
            ->distinct()
            ->column();
    }

    public function getDistinctLanguages()
    {
        return (new Query())
            ->select(['language'])
            ->from(Book::tableName())
            ->distinct()
            ->column();
    }

    public function getDistinctGenres()
    {
        return (new Query())
            ->select(['genre_id'])
            ->from(Book::tableName())
            ->distinct()
            ->column();
    }

    private function buildQuery($searchQuery, $searchAuthors, $searchLanguages, $searchGenre, $searchMinPage, $searchMaxPage)
    {
        $query = Book::find();

        if (!empty($searchQuery)) {
            $query->andWhere(['OR', ['ILIKE', 'title', $searchQuery], ['ILIKE', 'description', $searchQuery]]);
        }

        if (isset($searchAuthors) && is_array($searchAuthors) && !empty($searchAuthors)) {
            $query->andWhere(['IN', 'author_id', $searchAuthors]);
        }
        
        if (isset($searchLanguages) && is_array($searchLanguages) && !empty($searchLanguages)) {
            $query->andWhere(['IN', 'language', $searchLanguages]);
        }
        
        if (isset($searchGenre) && is_array($searchGenre) && isset($searchGenre['value'])) {
            $genreValue = $searchGenre['value'];
            $query->andWhere(['IN', 'genre_id', $searchGenre]);
        }

        if ($searchMinPage !== null && is_numeric($searchMinPage) && intval($searchMinPage) !== 0) {
            $query->andWhere(['>=', 'pages', $searchMinPage]);
        }

        if ($searchMaxPage !== null && is_numeric($searchMaxPage) && intval($searchMaxPage) !== 0) {
            $query->andWhere(['<=', 'pages', $searchMaxPage]);
        }

        return $query;
    }
}