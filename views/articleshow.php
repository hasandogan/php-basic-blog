<?php
require 'Layout/header.php';
$articleShow = new Article();
$slug = $response;
$rowArray = $articleShow->result($slug);
$articleRow = $rowArray[0];
$catRow = $rowArray[1];
$tagRow = $rowArray[2];
$id = $articleRow['id'];
$comments = $articleShow->comments($id);
?>
    <div class="container">
        <div class="show-article-container p-10 mt-3">
            <div class="show-article-head">
                <img class="show-article-img" src="/img/<?php echo $articleRow['image_path'] ?> ">
                <div class="show-article-title-container d-inline-block pl-5 align-middle">
                    <span class="show-article-title "><?php echo $articleRow['title'];
                        session_start();
                        $_SESSION['title'] = $articleRow['title'];
                        ?></span>
                    <br>
                    <span class="align-left article-details"><img class="article-author-img rounded-circle"
                                                                  src="https://robohash.org/<?php echo $articleRow['author'] ?>">
                    <?php echo $articleRow['author'] ?> </span>
                    <span class="pl-2 article-details"> 3 hours ago</span>
                    <span class="pl-2 article-details"><a
                                href="/categories/<?php echo $catRow['name'] ?> ">Categories:
                            <?php echo $catRow['name'] ?></a></span>
                    <?php
                    foreach ($tagRow as $tag) {
                        echo " <span class='badge badge-secondary'>" . $tag['tag_name'] . "</span>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="article-text">
                        <?php echo $articleRow['content'] ?>
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
                                        <input type="hidden" name="articleslug"
                                               value="<?php echo $articleRow['slug']; ?>">
                                        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                        <input type="hidden" name="id" value="<?php echo $articleRow['id']; ?>">
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
                    <?php
                    session_start();
                    foreach ($comments as $comment) {
                        ?>
                        <img class="comment-img rounded-circle"
                             src="https://robohash.org/<?php echo $comment['username'] ?>">
                        <div class="comment-container d-inline-block pl-3 align-top">
                            <span class="commenter-name"><?php echo $comment['username'] ?></span>
                            <br>
                            <span class="comment"><?php echo $comment['content'] ?></span>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php require 'Layout/footer.php' ?>