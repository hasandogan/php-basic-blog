<?php
require 'Layout/header.php';

$articleShow = new ArticleController();

$slug = $response;
$rowArray = $articleShow->result($slug);
$articleRow = $rowArray[0];
$catRow = $rowArray[1];
$tagRow = $rowArray[2];
$id = $articleRow->getId();
$comments = $articleShow->comments($id);
/** @var \src\entity\Article $articleRow */

$date = $articleRow->getCreatedAt();
$datetime = $date->format('Y-m-d H:i:s');
$timeAgo = $articleShow->timeAgo(strtotime($datetime));

?>
    <div class="container">
        <div class="show-article-container p-10 mt-3">
            <div class="show-article-head">
                <img class="show-article-img" src="/img/<?php echo $articleRow->getImagePath(); ?> ">
                <div class="show-article-title-container d-inline-block pl-5 align-middle">
                    <span class="show-article-title "><?php echo $articleRow->getTitle();
                        $_SESSION['title'] = $articleRow->getTitle(); ?></span>
                    <br>
                    <span class="align-left article-details"><img class="article-author-img rounded-circle"
                                                                  src="https://robohash.org/<?php echo $articleRow->getAuthor() ?>">
                    <?php echo $articleRow->getAuthor(); ?> </span>
                    <span class="pl-2 article-details"><?php echo $timeAgo ?></span>


                    <span class="pl-2 article-details"><a href="/categories/<?php  echo $catRow->getName(); ?> ">Categories:<?php echo $catRow->getName() ?></a></span>
                    <?php
                    foreach ($tagRow as $tag) {
                        echo " <span class='badge badge-secondary'>" . $tag->getTagName() . "</span>";
                    }

                    ?>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="article-text">
                        <?php echo $articleRow->getContent() ?>
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
                                    <form action="/comment" method="post">
                                        <span class="commenter-name"></span>
                                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                                        <input type="hidden" name="slug" value="<?php echo $articleRow->getSlug(); ?>">

                                        <input type="hidden" name="articleslug"
                                               value="<?php echo $articleRow->getSlug(); ?>">
                                        <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" name="id" value="<?php echo $articleRow->getId(); ?>">
                                        <div class="form-group">
                                            <textarea class="form-control comment-form" required=""
                                                      name="commentcontent"
                                                      rows="1"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row d-flex  mt-100 mb-100">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body text-center">
                                </div>
                                <div class="comment-widgets">
                                    <?php
                                    /** @var \src\entity\Comments $comment */
                                    foreach ($comments as $comment) {
                                        ?>
                                        <div class="d-flex flex-row comment-row m-t-0">
                                            <div class="p-2"><img
                                                        src="https://robohash.org/<?= $comment->getUsername() ?>"
                                                        alt="user" width="50" class="rounded-circle"></div>
                                            <div class="comment-text w-100">
                                                <h6 class="font-medium"><?= $comment->getUsername() ?></h6> <span
                                                        class="m-b-15 d-block"><?= $comment->getContent() ?></span>
                                                <div class="comment-footer">
                                                    <span class="text-muted float-right">
                                                        <?php
                                                        $datetime = $comment->getCreatedAt();
                                                        $date = $datetime->format('Y-m-d H:i:s');
                                                        $timeAgo = $articleShow->timeAgo(strtotime($date));

                                                        echo $timeAgo;
                                                        ?>
                                                    </span>
                                                    <button type="button" class="btn btn-danger btn-sm">Bildir</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'Layout/footer.php' ?>