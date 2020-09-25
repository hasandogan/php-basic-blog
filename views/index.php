<?php
$article = new HomepageController();
$categoryFilter = new Filter();
$pathname = $categoryFilter->getPathName(1);
$categoryArray = $categoryFilter->getArticleFromCategory();
$tags = $categoryFilter->getPathName(0);
if ($tags == 'tag') {
    $tagname = $categoryFilter->getPathName(1);
    $categoryArray = $categoryFilter->Tag($tagname);
    if (count($categoryArray['article'])>0){

    }else{
        $_SESSION['taghata'] = 'taghata';
    }
}else{
    $categoryArray = $categoryFilter->getArticleFromCategory();
}
$tag = $response['general']['tags'];
$category = $response['general']['categories'];

require 'Layout/header.php';

?>
<div class="container">
    <div class="row">
        <div class="col-xl-8">
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
            if (isset($_SESSION['catError'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh Olamaz</strong> Aradığınızı bulamadık
                </div>
                <?php
                unset($_SESSION['catError']);
            }
            ?>
            <?php
            if (count($categoryArray) > 0) {
                foreach ($categoryArray['article'] as $row) {
                    /** @var \src\entity\Article $row */
                        $detay = $row->getContent();
                        $uzunluk = strlen($detay);
                        $limit = 150;
                        $date = $row->getCreatedat();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $timeAgo = $categoryFilter->timeAgo(strtotime($datetime));
                        ?>
                        <div class="card mb-4">
                            <img class="card-img-top" src="/img/<?php echo $row->getImagePath()?>" width="300"
                                 height="350"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $row->getTitle() ?></h2>
                                <p class="card-text"><?php
                                    if ($uzunluk > $limit) {
                                        $detay = Strip_tags($detay);
                                        $detay = substr($detay, 0, $limit);
                                            echo $detay;
                                    }
                                    ?>
                                </p>

                                <a href="/article/<?php echo $row->getSlug(); ?>" class="btn btn-primary">Devamını Oku
                                    &rarr;</a>

                            </div>
                            <div class="card-footer text-muted">
                                <?php echo "Yayınlanma Tarihi " . $timeAgo ?>
                            </div>
                        </div>
                    <?php }

            } else {
                $_SESSION['taghata'] = 'taghata';
            } ?>
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
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="/search" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
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
                    <a href="/tag/<?php echo $row['tagname'] ?>"> <span
                                class='badge badge-secondary'><?php echo $row['tagname'] ?></span> </a>
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
                        foreach ($category as $row) {

                            ?>
                            <li>
                                <a href="/categories/<?php echo $row['name']; ?>"><strong><?php echo $row['name']; ?></strong></a>
                            </li>
                            <?php
                        } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'Layout/footer.php' ?>
