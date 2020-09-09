<?php

session_start();
$link = mysqli_connect("localhost", "root", "password", "blog");
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$tags = $pathArray[0];

$catsql = "select * FROM categories where categories LIKE '%$categoryName%'";
$catResult = mysqli_query($link, $catsql);
$catrow = mysqli_fetch_array($catResult);


if ($_SERVER['PATH_INFO'] == '/' . $pathArray[0] . '/' . $pathArray[1]) {
    $id = $catrow['id'];
    $categorySql = "SELECT * FROM article_categories where categoriesid='$id' ORDER BY id DESC LIMIT 10";
    $catResult = mysqli_query($link, $categorySql);
    $articleIdList = [];
    while ($catrow = mysqli_fetch_array($catResult)) {
        $articleId = $catrow['articleid'];
        $articleIdList[] = $articleId;
    }
    $articleIdList = implode(",", $articleIdList);
    $sql = "SELECT * FROM article where id in (" . $articleIdList . ")";
    $result = mysqli_query($link, $sql);
} else {
    $sql = "SELECT * FROM article order by id desc LIMIT 10";
    $result = mysqli_query($link, $sql);;
}

if (isset($_SESSION['search'])) {
    $article = $_SESSION['search'];
    $article = implode(",", $article);
    $sql = "SELECT * FROM article where id in (" . $article . ")";
    $result = mysqli_query($link, $sql);
    unset($_SESSION['search']);
}

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$tags = $pathArray[0];

if ($tags == 'tag') {
    $tagname = $pathArray[1];
    $tagsql = "SELECT * FROM tags where tag_name LIKE '%$tagname%'";
    $tagresult = mysqli_query($link, $tagsql);
    $articleIdList = [];
    while ($tagrow = mysqli_fetch_array($tagresult)) {
        $articleId = $tagrow['articleid'];
        $articleIdList[] = $articleId;
    }
    $articleIdList = implode(",", $articleIdList);
    $sql = "SELECT * FROM article where id in (" . $articleIdList . ")";
    $result = mysqli_query($link, $sql);


}


?>
<div class="col-md-8">
    <h1 class="my-4">Makaleler
    </h1>
    <?php

    if (isset($_SESSION['hata'])) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Aradığınızı bulamadık
        </div>
        <?php
        unset($_SESSION['hata']);
    }
    ?>

    <?php

    $rownum = mysqli_num_rows($result);


    if ($rownum == 0) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Aradığınızı bulamadık
        </div>
        <?php
    }
    ?>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $detay = $row['content'];
        $uzunluk = strlen($detay);
        $limit = 150;
        ?>
        <div class="card mb-4">
            <img class="card-img-top" src="/admin/img/<?php echo $row['image_path'] ?>" width="400" height="400"
                 alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['title'] ?></h2>
                <p class="card-text"><?php
                    if ($uzunluk > $limit) {
                        $detay = substr($detay, 0, $limit);
                    }
                    echo $detay;
                    ?>
                </p>
                <a href="/articleshow/<?php echo $row['slug'] ?>" class="btn btn-primary">Devamını Oku &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                <?php echo "Yayınlanma Tarihi " . $row['createdAt']; ?>
            </div>
        </div>
    <?php } ?>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="../views/index.php?page=">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>


            <li class="page-item active">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

</div>