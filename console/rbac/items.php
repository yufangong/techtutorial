<?php
return [
    'deletePost' => [
        'type' => 2,
        'description' => 'Delete a post',
    ],
    'createPost' => [
        'type' => 2,
        'description' => 'Create a post',
    ],
    'updatePost' => [
        'type' => 2,
        'description' => 'Update post',
    ],
    'uploadFile' => [
        'type' => 2,
        'description' => 'Upload files',
    ],
    'uploadOwnFile' => [
        'type' => 2,
        'description' => 'Upload own files',
        'ruleName' => 'isEditor',
        'children' => [
            'uploadFile',
        ],
    ],
    'updateOwnPost' => [
        'type' => 2,
        'description' => 'Update own post',
        'ruleName' => 'isEditor',
        'children' => [
            'updatePost',
        ],
    ],
    'user' => [
        'type' => 1,
    ],
    'editor' => [
        'type' => 1,
        'children' => [
            'createPost',
            'user',
            'updateOwnPost',
            'uploadOwnFile',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updatePost',
            'uploadFile',
            'deletePost',
            'editor',
        ],
    ],
];
