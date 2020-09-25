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
        "template" => "index.php"
    ],
    "index" => [
        "url" => "^/admin/$",
        "class" => "HomepageController",
        "action" => "index",
        "type" => "normal",
        "template" => "index.php"
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
        "template" => "login.php"
    ],


    "editarticle" => [
        "url" => "/editarticle/(\d+)",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "template" => "editarticle.php"
    ],
    "articleadd" => [
        "url" => "/articledd",
        "class" => "ArticleController",
        "action" => "add",
        "type" => "check",
    ],
    "articlenew" => [
        "url" => "/articlenew",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "template" => "articlenew.php"
    ],
    "article" => [
        "url" => "/article",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "template" => "article.php"
    ],
    "update-article" => [
        "url" => "/update-article",
        "class" => "ArticleController",
        "action" => "update",
        "type" => "check",
    ],
    "delete-article" => [
        "url" => "/delete-article/(\d+)",
        "class" => "ArticleController",
        "action" => "delete",
        "type" => "check",
    ],
    "categories" => [
        "url" => "/categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "template" => "categories.php"
    ],
    "categoriesView" => [
        "url" => "/view-add-categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "template" => "addcategories.php"
    ],
    "categoriesadd" => [
        "url" => "/addcategories",
        "class" => "CategoriesController",
        "action" => "add",
        "type" => "normal",
    ],
    "update-categories" => [
        "url" => "/updatecategories",
        "class" => "CategoriesController",
        "action" => "update",
        "type" => "normal",
    ],
    "delete-categories" => [
        "url" => "/deletecategories/(\d+)",
        "class" => "CategoriesController",
        "action" => "delete",
        "type" => "check",
    ],
    "edit-categories" => [
        "url" => "/view-edit-categories",
        "class" => "CategoriesController",
        "action" => "show",
        "type" => "normal",
        "template" => "editcategories.php"
    ],
    "Viewcomment" => [
        "url" => "/view-comment",
        "class" => "commentController",
        "action" => "show",
        "type" => "normal",
        "template" => "comment.php"
    ],
    "confirmComment" => [
        "url" => "/confirm-comment/(\d+)",
        "class" => "commentController",
        "action" => "confirmed",
        "type" => "check",
    ],
    "deleteComment" => [
        "url" => "/Delete-comment/(\d+)",
        "class" => "commentController",
        "action" => "delete",
        "type" => "check",
    ],
    "admin" => [
        "url" => "/view-Admin",
        "class" => "AdminController",
        "action" => "show",
        "type" => "check",
        "template" => "admin.php"
    ],
    "view-add-Admin" => [
        "url" => "/view-adminadd",
        "class" => "AdminController",
        "action" => "show",
        "type" => "normal",
        "template" => "newadmin.php"
    ],
    "add-AdminController" => [
        "url" => "/adminadd",
        "class" => "AdminController",
        "action" => "add",
        "type" => "check",
    ],
    "delete-AdminController" => [
        "url" => "/delete-admin/(\d+)",
        "class" => "AdminController",
        "action" => "delete",
        "type" => "check",
    ],
    "view-UserController" => [
        "url" => "/view-user",
        "class" => "UserController",
        "action" => "show",
        "type" => "normal",
        "template" => "user.php"
    ],
    "logout" => [
        "url" => "/logout",
        "class" => "AdminLoginCheck",
        "action" => "logout",
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
            if ($router["type"] == "normal") {
                $className = new $router['class'];
                $actionName = $router['action'];
                $response = call_user_func_array(array($className, $actionName), $matches);
                $templateFile = $router['template'];
                $templateFilePath = __DIR__ . "/views/" . $templateFile;
                if (!file_exists($templateFilePath)) {
                    echo "404";
                    exit;
                }
                require_once $templateFilePath;
                break;
            } else if ($router["type"] == "check") {
                $className = new $router['class'];
                $actionName = $router['action'];
                $response = call_user_func_array(array($className, $actionName), $matches);
                $templateFile = $router['template'];
                $templateFilePath = __DIR__ . "/views/" . $templateFile;
                if (!file_exists($templateFilePath)) {
                    echo "404";
                    exit;
                }
                require_once $templateFilePath;
                break;
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit;
        }
    }
}



