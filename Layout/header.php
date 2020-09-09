<?php
session_start();
include "logincheck.php";
$sql = 'Select * From categories';
$result = mysqli_query($link, $sql);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/font-awesome.css">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php if (isset($_SERVER['PATH_INFO'])){
        $path = $_SERVER['PATH_INFO'];
        $path = substr($path, 1);
        $pathArray = explode('/', $path);
        $titleConverter = explode('-', $pathArray[1]);
        $title = implode(" ", $titleConverter);

        echo "<title>$title</title>";
    }else{
        echo "<title>Hasan Dogan Blog</title>";


    }?>
<title></title>



    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/blog-home.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Blog</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categories
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <a class="dropdown-item"
                       href="categories/<?php echo $row['categories'] ?>"><?php echo $row['categories']
                        ?></a>
                <?php } ?>
            </div>
        </div>
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
                        <a class="nav-link" href="profile">Profile</a>
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
