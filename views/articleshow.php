<?php
include 'Layout/header.php';
include 'connect.php';

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$converter = explode('-', $pathArray[1]);
$slugconverter = implode('-', $converter);

if (isset($slugconverter)) {
    $articlequery = $conn->query("SELECT * FROM article where slug LIKE '%$slugconverter%'");
    if ($query->rowCount()) {
        foreach ($articlequery as $artrow) {

        }
    }
    $id = $artrow['id'];
    $catquery = $conn->query("SELECT * FROM article_categories where articleid='$id'");
    if ($query->rowCount()) {
        foreach ($catquery as $row) {
        }
    }
    $catid = $row['categoriesid'];
    $showcatquery = $conn->query("SELECT * FROM  categories where id='$catid'");

} else {
    header('loaction:   /');
}

$tagquery = $conn->query("SELECT * FROM tags where articleid='$id'");


?>

    <div class="container">
        <div class="show-article-container p-10 mt-3">
            <div class="show-article-head">
                <img class="show-article-img" src="/admin/img/<?php echo $artrow['image_path'] ?> ">
                <div class="show-article-title-container d-inline-block pl-5 align-middle">
                    <span class="show-article-title "><?php echo $artrow['title'];
                        session_start();
                        $_SESSION['title'] = $artrow['title'];
                        ?></span>
                    <br>
                    <span class="align-left article-details"><img class="article-author-img rounded-circle"
                                                                  src="https://robohash.org/<?php echo $artrow['author'] ?>">
                    <?php echo $row['author'] ?> </span>
                    <span class="pl-2 article-details"> 3 hours ago</span>
                    <span class="pl-2 article-details"><a
                                href="/categories/<?php
                                if ($showcatquery->rowCount()) {
                                    foreach ($showcatquery as $categoriesrow) {

                                    }
                                }
                                echo $categoriesrow['name'] ?> ">Categories:
                            <?php echo $categoriesrow['name'] ?></a></span>
                    <?php
                    if ($tagquery->rowCount()) {
                        foreach ($tagquery as $tag) {
                            echo " <span class='badge badge-secondary'>" . $tag['tag_name'] . "</span>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="article-text">
                        <?php echo $artrow['content'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <hr>
                    <h3><i class="pr-md-5 fa fa-comment"></i>Comments</h3>
                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        ?>
                        <div class="row mb-5">
                            <div class="col-sm-12">
                                <img class="comment-img rounded-circle"
                                     src="https://robohash.org/<?php echo $_SESSION['username'] ?>?size=150x150">
                                <div class="comment-container d-inline-block pl-3 align-top">
                                    <form action="../commentdb.php" method="post">
                                        <span class="commenter-name"></span>
                                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                                        <input type="hidden" name="articleslug" value="<?php echo $artrow['slug']; ?>">
                                        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                        <input type="hidden" name="id" value="<?php echo $artrow['id']; ?>">
                                        <div class="form-group">
                                            <textarea class="form-control comment-form" name="commentcontent"
                                                      rows="1"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } else {
                    } ?>
                    <?php $commentquery = $conn->query("SELECT * FROM comments where confirmed='1' and articleid='$id'");
                    if ($commentquery->rowCount()) {
                        ?>
                        <?php
                        session_start();
                        foreach ($commentquery as $comment) {
                            ?>
                            <img class="comment-img rounded-circle"
                                 src="https://robohash.org/<?php echo $comment['username'] ?>">
                            <div class="comment-container d-inline-block pl-3 align-top">
                                <span class="commenter-name"><?php echo $comment['username'] ?></span>
                                <br>
                                <span class="comment"><?php echo $comment['content'] ?></span>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

<?php require 'Layout/footer.php' ?>