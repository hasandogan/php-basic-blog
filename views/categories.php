<?php
$filter = new Filter();
$path = $filter->getPathName(1);
$category = $filter->CategoryView($path);
$catid = $category['category']['id'];
    $article = $filter->getArticleFromCategory($catid);
    $response = $article;
    $_SESSION['cateError'] = 'catError';
require 'Layout/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="my-4">Makaleler</h1>
            <div class="alert alert-dark"><?=$path;?> için arama sonuçları.</div>
            <?php
                        if (empty($response['totalCount'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh Olamaz</strong> Aradığınızı bulamadık
                </div>
                <?php
            }
            if (count($response['totalCount']) > 0) {
                foreach ($response['article'] as $row) {
                    if (isset($row)) {
                        $detay = $row['content'];
                        $uzunluk = strlen($detay);
                        $limit = 150;
                        ?>
                        <div class="card mb-4">
                            <img class="card-img-top" src="/img/<?php echo $row['image_path'] ?>" width="400"
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
                                <a href="/article/<?php echo $row['slug'] ?>" class="btn btn-primary">Devamını Oku
                                    &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo "Yayınlanma Tarihi " . $row['createdAt']; ?>
                            </div>
                        </div>
                    <?php }
                }
            }
            ?>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="search" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?=$path; ?>" name="search"
                                   placeholder="Search for...">
                            <span class="input-group-append">
                         <input type="submit">
                                    </span>
                    </form>
                </div>
            </div>
        </div>
        <div class="card my-4">
            <h5 class="card-header">Last add Tags </h5>
            <div class="card-body">
                <?php

                foreach ($tag as $row) {

                    ?>
                    <a href="/tag/<?php echo $row['tag_name'] ?>"> <span
                            class='badge badge-secondary'><?php echo $row['tag_name'] ?></span> </a>
                    <?php
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="single category">
                    <h3 class="side-title">Category</h3>
                    <ul class="list-unstyled">
                        <?php
                        foreach ($response['category'] as $row) {
                                                        ?>
                            <li><a href="/categories/<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></li>
                            <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'Layout/footer.php' ?>
