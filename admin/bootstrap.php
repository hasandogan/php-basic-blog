<?php
require_once __DIR__ . "/load.php";
session_start();
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
    "article_show" => [
        "url" => "article",
        "class" => "Article",
        "action" => "show",
        "type" => "normal",
        "template" => "article.php"
    ],
    "check-login" => [
        "url" => "check-login",
        "class" => "User",
        "action" => "logincheck",
        "type" => "check",
    ],
    "login" => [
        "url" => "login",
        "class" => "User",
        "action" => "login",
        "type" => "normal",
        "template" => "/login.php"
    ],
    "profile" => [
        "url" => "profile",
        "class" => "User",
        "action" => "profile",
        "type" => "normal",
        "template" => "/profile.php"
    ],
    "check-register" => [
        "url" => "check-register",
        "class" => "User",
        "action" => "registerCheck",
        "type" => "check"
    ],


    "category" => [
        "url" => "categories/([a-z0-9-?&]+)",
        "class" => "Filter",
        "action" => "categoryView",
        "type" => "normal",
        "template" => "index.php"
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
        "class" => "User",
        "action" => "logout",
        "type" => "check",
        "template" => "logout.php"
    ],
    "comment" => [
        "url" => "comment",
        "class" => "Comment",
        "action" => "addComment",
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



