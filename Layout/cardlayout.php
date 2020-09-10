<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=blog", "root", "password");
} catch (PDOException $e) {
    print $e->getMessage();
}
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$pathname = $pathArray[1];

$query = $conn->query("select * FROM categories where name LIKE '%$pathname%'");
if ($query->rowCount()) {
    foreach ($query as $catrow) {
    }
}

if ($_SERVER['PATH_INFO'] == '/' . $pathArray[0] . '/' . $pathArray[1]) {
    $id = $catrow['id'];
    $pathquery = $conn->query("SELECT * FROM  article_categories where categoriesid='$id' ORDER BY id DESC LIMIT 10");
    if ($pathquery->rowCount()) {
        $articleIdList = [];
        foreach ($pathquery as $catrow) {
            $articleId = $catrow['articleid'];
            $articleIdList[] = $articleId;
        }
    }

    $articleIdList = implode(",", $articleIdList);

    $query = $conn->query("SELECT * FROM article where id in (" . $articleIdList . ")");
} else {
    $query = $conn->query("SELECT * FROM article order by id desc LIMIT 10");
}

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$tags = $pathArray[0];

if ($tags == 'tag') {
    $tagname = $pathArray[1];
    $query = $conn->query("SELECT * FROM tags where tag_name LIKE '%$tagname%'");
    if ($query->rowCount()) {
        $articleIdList = [];
        foreach ($query as $tagrow) {
            $articleId = $tagrow['articleid'];
            $articleIdList[] = $articleId;
        }
    }
    $articleIdList = implode(",", $articleIdList);
    $query = $conn->query("SELECT * FROM article where id in (" . $articleIdList . ")");
}
if (isset($_SESSION['search'])) {
    $article = $_SESSION['search'];
    $article = implode(",", $article);
    $query = $conn->query("SELECT * FROM article where id in (" . $article . ")");
    unset($_SESSION['search']);
}
?>
<div class="col-md-8">
    <h1 class="my-4">Makaleler
    </h1>
    <?php
    if (isset($_SESSION['searchhatası'])) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Aradığınızı bulamadık
        </div>
        <?php
        unset($_SESSION['searchhatası']);
    }
    ?>
        <?php
        if ($query->rowCount()) {
            foreach ($query as $row) {
                if (isset($row)) {
                    $detay = $row['content'];
                    $uzunluk = strlen($detay);
                    $limit = 150;
                    ?>
                    <div class="card mb-4">
                        <img class="card-img-top" src="/admin/img/<?php echo $row['image_path'] ?>" width="400"
                             height="400"
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
                            <a href="/articleshow/<?php echo $row['slug'] ?>" class="btn btn-primary">Devamını Oku
                                &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            <?php echo "Yayınlanma Tarihi " . $row['createdAt']; ?>
                        </div>
                    </div>
                <?php }}}else{
            session_start();
                $_SESSION['taghata'] = 'taghata';

        }?>
    <?php
    if (isset($_SESSION['taghata'])) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Aradığınızı bulamadık
        </div>
        <?php
        unset($_SESSION['taghata']);
    }
    ?>
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