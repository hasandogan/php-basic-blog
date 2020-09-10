<?php
$request = $_SERVER['REQUEST_URI'];

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);


switch ($pathArray[0]) {
    case 'index' :
        require __DIR__ . '/views/index.php';
        break;
    case '/' :
        require __DIR__ . '/views/index.php';
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
    case 'article' :
        require __DIR__ . '/views/article.php';
        break;
    case 'categories':
        require __DIR__ . '/views/categorieslist.php';
        break;
    case 'articlenew':
        require __DIR__ . '/views/articlenew.php';
        break;
    case 'editarticle':
        require __DIR__ . '/views/editarticle.php';
        break;
    case 'articleupdate':
        require __DIR__ . '/conf/articleupdate.php';
        break;
    case 'config':
        require __DIR__ . '/conf/config.php';
        break;
    case 'articleadd':
        require __DIR__ . '/conf/articleadd.php';
        break;
    case 'editcategories' :
        require __DIR__ . '/views/categoriesedit.php';
        break;
    case 'categoriesedit' :
        require __DIR__ . '/conf/categories.php';
        break;
    case 'categoriesadd' :
        require __DIR__ . '/views/categoriesadd.php';
        break;
    case 'commentlist' :
        require __DIR__ . '/views/comment.php';
        break;
    case 'categoriesupdate' :
        require __DIR__ . '/views/categorieslist.php';
        break;
    case 'user' :
        require __DIR__ . '/views/user.php';
        break;
    case 'admin' :
        require __DIR__ . '/views/admin.php';
        break;
    case 'newuser' :
        require  __DIR__ . '/views/usernew.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
