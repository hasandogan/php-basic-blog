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
        "template" => "index.html.twig"
    ],
    "article_show" => [
        "url" => "article/([a-z0-9-?&]+)",
        "class" => "ArticleController",
        "action" => "show",
        "type" => "normal",
        "template" => "articleshow.html.twig"
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
        "template" => "login.html.twig"
    ],
    "profile" => [
        "url" => "profile",
        "class" => "UserController",
        "action" => "profileResult",
        "type" => "normal",
        "template" => "/profile.html.twig"
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
        "template" => "/register.html.twig"
    ],
    "tag" => [
        "url" => "tag/([a-z0-9-?&]+)",
        "class" => "Filter",
        "action" => "tag",
        "type" => "normal",
        "template" => "index.html.twig"
    ],
    "category" => [
        "url" => "categories/([a-z0-9-?&]+)",
        "class" => "Filter",
        "action" => "categoryView",
        "type" => "normal",
        "template" => "categories.html.twig"
    ],
    "search" => [
        "url" => "search",
        "class" => "Filter",
        "action" => "search",
        "type" => "normal",
        "template" => "search.html.twig"
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
    ],
    "page" => [
        "url" => "/page/(\d+)",
        "class" => "ArticleController",
        "action" => "pagination",
        "type" => "check",
        "template" => "index.html.twig"
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
            } else if ($router["type"] == "check") {
                $className = new $router['class'];
                $actionName = $router['action'];
                $response = call_user_func_array(array($className, $actionName), $matches);
                $templateFile = $router['template'];
                $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/template/");
                $twig = new \Twig\Environment($loader, []);
                echo $twig->render($router['template'], $response);
                if (!file_exists($templateFilePath)) {
                    echo "404";
                    exit;
                }
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit;
        }
    }
}
