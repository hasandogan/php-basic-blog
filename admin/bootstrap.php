<?php
require_once __DIR__ . "/load.php";
$isUrlFount = false;
$uri = $_SERVER['REQUEST_URI'];
$routers = [
    "homepage" => [
        "url" => "^/$",
        "class" => "Homepage",
        "action" => "index",
        "type" => "normal",
        "template" => "index.php"
 ],
    "index" => [
        "url" => "^/admin/$",
        "class" => "Homepage",
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
        "class" => "Article",
        "action" => "show",
        "type" => "normal",
        "template" =>"editarticle.php"
    ],
    "articleadd" => [
        "url" => "/articledd",
        "class" => "Article",
        "action" => "add",
        "type" => "check",
    ],
    "articlenew" => [
        "url" => "/articlenew",
        "class" => "Article",
        "action" => "show",
        "type" => "normal",
        "template" =>"articlenew.php"
    ],
    "article" => [
        "url" => "/article",
        "class" => "Article",
        "action" => "show",
        "type" => "normal",
        "template" =>"article.php"
    ],
    "update-article" => [
        "url" => "/update-article",
        "class" => "Article",
        "action" => "update",
        "type" => "check",
    ],
    "delete-article" => [
        "url" => "/delete-article/(\d+)",
        "class" => "Article",
        "action" => "delete",
        "type" => "check",
    ],
    "categories" => [
        "url" => "/categories",
        "class" => "Categories",
        "action" => "show",
        "type" => "normal",
        "template" => "categories.php"
    ],
    "categoriesView" => [
        "url" => "/view-add-categories",
        "class" => "Categories",
        "action" => "show",
        "type" => "normal",
        "template" => "addcategories.php"
    ],
    "categoriesadd" => [
        "url" => "/addcategories",
        "class" => "Categories",
        "action" => "add",
        "type" => "normal",
    ],
    "update-categories" => [
        "url" => "/updatecategories",
        "class" => "Categories",
        "action" => "update",
        "type" => "normal",
    ],
    "delete-categories" => [
        "url" => "/deletecategories/(\d+)",
        "class" => "Categories",
        "action" => "delete",
        "type" => "check",
    ],
    "edit-categories" => [
        "url" => "/view-edit-categories",
        "class" => "Categories",
        "action" => "show",
        "type" => "normal",
        "template" => "editcategories.php"
    ],
    "Viewcomment" => [
        "url" => "/view-comment",
        "class" => "comment",
        "action" => "show",
        "type" => "normal",
        "template" => "comment.php"
    ],
    "confirmComment" => [
        "url" => "/confirm-comment/(\d+)",
        "class" => "comment",
        "action" => "confirmed",
        "type" => "check",
    ],
    "deleteComment" => [
        "url" => "/Delete-comment/(\d+)",
        "class" => "comment",
        "action" => "delete",
        "type" => "check",
    ],
    "admin" => [
        "url" => "/view-Admin",
        "class" => "Admin",
        "action" => "show",
        "type" => "check",
        "template" => "admin.php"
    ],
    "view-add-Admin" => [
        "url" => "/view-adminadd",
        "class" => "Admin",
        "action" => "show",
        "type" => "normal",
        "template" => "newadmin.php"
    ],
    "add-Admin" => [
        "url" => "/adminadd",
        "class" => "Admin",
        "action" => "add",
        "type" => "check",
    ],
    "delete-Admin" => [
        "url" => "/delete-admin/(\d+)",
        "class" => "Admin",
        "action" => "delete",
        "type" => "check",
    ],
    "view-User" => [
        "url" => "/view-user",
        "class" => "User",
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
    $result = preg_match("/" . $routerSlashed. "/", $uri, $matches);
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



