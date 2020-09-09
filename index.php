<?php
$request = $_SERVER['REQUEST_URI'];


$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);


switch ($pathArray[0]) {
    case 'categories' :
        require __DIR__ . '/views/index.php';
        break;
    case 'tag' :
        require __DIR__ . '/views/index.php';
        break;
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case 'articles' :
        require __DIR__ . '/views/articleshow.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case 'logout' :
        require __DIR__ . '/views/logout.php';
        break;
    case 'login' :
        require __DIR__ . '/views/login.php';
        break;
    case 'profile' :
        require __DIR__ . '/views/profile.php';
        break;
    case 'articleshow' :
        require __DIR__ . '/views/articleshow.php';
        break;
    case 'register' :
        require __DIR__ . '/views/register.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
