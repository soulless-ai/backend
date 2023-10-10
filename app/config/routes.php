<?php
use yii\web\UrlRule;

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['api/books'],
        'except' => ['delete'],
        'extraPatterns' => [
            'GET get-books' => 'get-books',
            'GET get-authors' => 'get-authors',
            'GET get-languages' => 'get-languages',
            'GET get-genres' => 'get-genres',
            'POST create-book' => 'create-book',
        ],
    ],
];