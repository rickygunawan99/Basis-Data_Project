<?php

namespace PHP\MVC\App;

class View
{
    public static function show(string $path, $model)
    {
        require __DIR__ . '/../View/header.php';
        require __DIR__ . '/../View/' . $path . '.php' ;
        require __DIR__ . '/../View/footer.php';
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}