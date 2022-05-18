<?php

function getArrayDatabase():array
{
    return [
        'database' => [
            'prod' => [
                'url' => 'mysql:host=localhost:3306;dbname=bd-project-test',
                'username' => 'root',
                'password' => ''
            ]
        ]
    ];
}