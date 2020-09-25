<?php
session_start();
require_once "vendor/autoload.php";
require_once "load.php";
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
    "article_show" => [
        "url" => "article/([a-z0-9-?&]+)",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "template" => "articleshow.php"
    ],
    "check-login" => [
        "url" => "logincheck",
        "class" => "UserController",
        "action" => "logincheck",
        "type" => "check",
    ],
    "login" => [
        "url" => "login",
        "class" => "UserController",
        "action" => "login",
        "type" => "normal",
        "template" => "/login.php"
    ],
    "profile" => [
        "url" => "profile",
        "class" => "UserController",
        "action" => "profile",
        "type" => "normal",
        "template" => "/profile.php"
    ],
    "check-register" => [
        "url" => "check-register",
        "class" => "UserController",
        "action" => "registerCheck",
        "type" => "check"
    ],
    "register" => [
        "url" => "register",
        "class" => "UserController",
        "action" => "register",
        "type" => "normal",
        "template" => "/register.php"
    ],
    "tag" => [
        "url" => "tag/([a-z0-9-?&]+)",
        "class" => "Filter",
        "action" => "tag",
        "type" => "normal",
        "template" => "index.php"
    ],
    "category" => [
        "url" => "categories/([a-z0-9-?&]+)",
        "class" => "Filter",
        "action" => "categoryView",
        "type" => "normal",
        "template" => "categories.php"
    ],
    "search" => [
        "url" => "search",
        "class" => "Filter",
        "action" => "search",
        "type" => "normal",
        "template" => "search.php"
    ],
    "logout" => [
        "url" => "logout",
        "class" => "UserController",
        "action" => "logout",
        "type" => "check",

    ],
    "comment" => [
        "url" => "comment",
        "class" => "CommentController",
        "action" => "addComment",
        "type" => "check",
    ]
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
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit;
        }
    }
}
