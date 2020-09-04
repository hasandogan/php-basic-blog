<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categorysql = "SELECT * FROM article_categories where categoriesid='$id' ORDER BY id DESC LIMIT 2";
    $catresult = mysqli_query($link, $categorysql);
    $articleIdList = [];
    while ($catrow = mysqli_fetch_array($catresult)) {
        $articleid = $catrow['articleid'];
        $articleIdList[] = $articleid;
    }

    $articleIdList = implode(",", $articleIdList);

    $sql = "SELECT * FROM article where id in (" . $articleIdList . ")";
    $result = mysqli_query($link, $sql);
} else {
    $sql = "SELECT * FROM article order by id desc LIMIT 10";
    $result = mysqli_query($link, $sql);
}
?>
<div class="col-md-8">

    <h1 class="my-4">Makaleler
    </h1>

    <?php while ($row = mysqli_fetch_array($result)) {
        $detay = $row['content'];
        $uzunluk = strlen($detay);
        $limit = 150;
        ?>
        <div class="card mb-4">
            <img class="card-img-top" src="/admin/img/<?php echo $row['image_path'] ?>" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['title'] ?></h2>

                <p class="card-text"><?php
                    if ($uzunluk > $limit) {
                        $detay = substr($detay, 0, $limit);
                    }
                    echo $detay;
                    ?>
                </p>
                <a href="/articleshow.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Devamını Oku &rarr;</a>
            </div>
            <div class="card-footer text-muted">

                <?php echo "Yayınlanma Tarihi " . $row['createdAt']; ?>
            </div>
        </div>

    <?php } ?>
    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
            <a class="page-link" href="index.php?page=2">&larr; Older</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" href="index.php?page=2">Newer &rarr;</a>
        </li>
    </ul>

</div>