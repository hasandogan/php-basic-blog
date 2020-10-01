<?php
session_start();
require_once __DIR__ . "../../vendor/autoload.php";
require_once __DIR__ . "/load.php";
$isUrlFount = false;
$uri = $_SERVER['REQUEST_URI'];
$routers = [
    "homepage" => [
        "url" => "^/$",
        "class" => "HomepageController",
        "action" => "index",
        "type" => "normal",
        "template" => "index.html.twig"
    ],
    "index" => [
        "url" => "^/admin/$",
        "class" => "HomepageController",
        "action" => "index",
        "type" => "normal",
        "needPermission" => true,
        "template" => "index.html.twig"
    ],
    "login-check" => [
        "url" => "/login-check",
        "class" => "AdminLoginCheck",
        "action" => "loginCheck",
        "type" => "check",
    ],
    "login" => [
        "url" => "/login",
        "class" => "AdminLoginCheck",
        "action" => "login",
        "type" => "normal",
        "template" => "login.html.twig"
    ],
    "editarticle" => [
        "url" => "/editarticle/(\d+)",
        "class" => "ArticleController",
        "action" => "edit",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/article/editarticle.html.twig"
    ],
    "articleadd" => [
        "url" => "/articledd",
        "class" => "ArticleController",
        "action" => "add",
        "needPermission" => true,
        "type" => "check",
    ],
    "articlenew" => [
        "url" => "/articlenew",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/article/articlenew.html.twig"
    ],
    "article" => [
        "url" => "/article",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/article/article.html.twig"
    ],
    "update-article" => [
        "url" => "/update-article",
        "class" => "ArticleController",
        "action" => "update",
        "needPermission" => true,
        "type" => "check",
    ],
    "delete-article" => [
        "url" => "/delete-article/(\d+)",
        "class" => "ArticleController",
        "action" => "delete",
        "needPermission" => true,
        "type" => "check",
    ],
    "categories" => [
        "url" => "/categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/category/categories.html.twig"
    ],
    "categoriesView" => [
        "url" => "/view-add-categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/category/addcategories.html.twig"
    ],
    "categoriesadd" => [
        "url" => "/addcategories",
        "class" => "CategoriesController",
        "action" => "add",
        "needPermission" => true,
        "type" => "normal",
    ],
    "update-categories" => [
        "url" => "/updatecategories",
        "class" => "CategoriesController",
        "action" => "update",
        "needPermission" => true,
        "type" => "normal",
    ],
    "delete-categories" => [
        "url" => "/deletecategories/(\d+)",
        "class" => "CategoriesController",
        "action" => "delete",
        "needPermission" => true,
        "type" => "check",
    ],
    "edit-categories" => [
        "url" => "/view-edit-categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/category/editcategories.html.twig"
    ],
    "Viewcomment" => [
        "url" => "/view-comment",
        "class" => "commentController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/comment/comment.html.twig"
    ],
    "confirmComment" => [
        "url" => "/confirm-comment/(\d+)",
        "class" => "commentController",
        "action" => "confirmed",
        "needPermission" => true,
        "type" => "check",
    ],
    "deleteComment" => [
        "url" => "/Delete-comment/(\d+)",
        "class" => "commentController",
        "action" => "delete",
        "needPermission" => true,
        "type" => "check",
    ],
    "admin" => [
        "url" => "/view-admin",
        "class" => "AdminController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/admin/admin.html.twig"
    ],
    "view-add-Admin" => [
        "url" => "/view-adminadd",
        "class" => "AdminController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "/admin/newadmin.html.twig"
    ],
    "add-AdminController" => [
        "url" => "/adminadd",
        "class" => "AdminController",
        "action" => "add",
        "needPermission" => true,
        "type" => "check",
    ],
    "delete-AdminController" => [
        "url" => "/delete-admin/(\d+)",
        "class" => "AdminController",
        "action" => "delete",
        "needPermission" => true,
        "type" => "check",
    ],
    "view-UserController" => [
        "url" => "/view-user",
        "class" => "UserController",
        "action" => "show",
        "type" => "normal",
        "needPermission" => true,
        "template" => "user.html.twig"
    ],
    "logout" => [
        "url" => "/logout",
        "class" => "AdminLoginCheck",
        "action" => "logout",
        "needPermission" => true,
        "type" => "check",
    ],

];
foreach ($routers as $router) {
    $routerSlashed = str_replace("/", "\/", $router["url"]);
    $result = preg_match("/" . $routerSlashed . "/", $uri, $matches);
    if ($result == 1) {
        unset($matches[0]);
        if (count($matches) > 0) {
            sort($matches);
        }

        try {
            if ($router['needPermission'] === true) {
                if (!isset($_SESSION['user_type']) || !$_SESSION['user_type'] === 'admin') {
                    header("location: /admin/login");
                }
            }
            if ($router["type"] == "normal") {
                $className = new $router['class'];
                $actionName = $router['action'];
                $response = call_user_func_array(array($className, $actionName), $matches);
                $templateFile = $router['template'];
                $templateFilePath = __DIR__ . "/template/" . $templateFile;
                $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/template/");
                $twig = new \Twig\Environment($loader, [
                    'debug' => true,
                ]);
                $twig->addGlobal('session', $_SESSION);
                $twig->addExtension(new \Twig\Extension\DebugExtension());
                if ($response != null) {
                    echo $twig->render($templateFile, $response);
                } else {
                    echo $twig->render($templateFile);
                }
                if (!file_exists($templateFilePath)) {
                    echo "404";
                    exit;
                }
                break;
            } else if ($router["type"] == "check") {

                $className = new $router['class'];
                $actionName = $router['action'];
                $response = call_user_func_array(array($className, $actionName), $matches);
                $templateFile = $router['template'];
                $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/template/");
                $twig = new \Twig\Environment($loader, []);
                echo $twig->render($router['template'], $response);
                break;
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit;
        }
    }
}
