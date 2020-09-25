<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/font-awesome.css">
<link href='//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    if (isset($_SERVER['REQUEST_URI'])) {
        $path = $_SERVER['REQUEST_URI'];
        $path = substr($path, 1);
        $pathArray = explode('/', $path);
        $titleConverter = explode('-', $pathArray[1]);
        $title = implode(" ", $titleConverter);

        echo "<title>$title</title>";
    } else {
        echo "<title>Hasan Dogan Blog</title>";

    } ?>


    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/blog-home.css" rel="stylesheet">
    <link href="/css/category.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="opacity:75%">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/pngegg.png" width="120" height="40"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <?php if (isset($_SESSION['username'])){ ?>
                    <li>
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/logout">logout</a>
                    </li>
                    <img class="nav-profile-img rounded-circle"
                         src="https://robohash.org/<?php echo $_SESSION['username'] ?>?size=150x150">
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>
