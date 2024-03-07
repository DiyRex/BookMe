<?php

function dd() {
    echo '<pre>';
    echo 'GET Data:';
    var_dump($_GET);
    
    echo 'POST Data:';
    var_dump($_POST);

    echo 'Request Headers:';
    var_dump(getallheaders());

    echo 'Request Method:';
    var_dump($_SERVER['REQUEST_METHOD']);

    echo 'Request URI:';
    var_dump($_SERVER['REQUEST_URI']);

    echo '</pre>';
    die();
}

function ddx(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    echo var_dump($var);
    die();
}
