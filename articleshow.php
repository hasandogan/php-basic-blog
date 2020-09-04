<?php
include 'Layout/header.php';
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM tags where articleid='$id'";
$result = mysqli_query($link, $sql);


if (isset($id)) {
    $sql = "SELECT * FROM article where id='$id'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);
} else {
    header('loaction: index.php');
}
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="show-article-container p-3 mt-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <img class="show-article-img" src="/admin/img/<?php echo $row['image_path'] ?>">
                            <div class="show-article-title-container d-inline-block pl-3 align-middle">
                                <span class="show-article-title "><?php echo $row['title'] ?></span>
                                <br>
                                <span class="align-left article-details"><img class="article-author-img rounded-circle" src="https://robohash.org/<?php echo $row['author'] ?>">
                                    <?php echo $row['author'] ?> </span>
                                <span class="pl-2 article-details"> 3 hours ago</span>
                                <?php
                                while ($tag = mysqli_fetch_array($result)) {
                                    echo " <span class='badge badge-secondary'>" . $tag['tag_name'] . "</span>";
                                }
                                ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="article-text">
                                <?php echo $row['content'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="share-icons mb-5"><span class="pr-1">Share:</span> <i
                                        class="pr-1 fa fa-facebook-square"></i><i class="pr-1 fa fa-twitter-square"></i><i
                                        class="pr-1 fa fa-reddit-square"></i><i class="pr-1 fa fa-share-alt-square"></i>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php $i = 0; ?>
                            <h3><i class="pr-3 fa fa-comment"></i> Comments</h3>
                            <hr>
                            <?php
                            if (isset($_SESSION['username'])){
                            $username = $_SESSION['username'];
                            ?>
                            <div class="row mb-5">
                                <div class="col-sm-12">
                                    <img class="comment-img rounded-circle"
                                         src="https://robohash.org/<?php echo $_SESSION['username'] ?>?size=150x150">
                                    <div class="comment-container d-inline-block pl-3 align-top">
                                        <form action="commentdb.php" method="post">
                                            <span class="commenter-name"></span>
                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                            <textarea class="form-control comment-form" name="commentcontent"
                                                      rows="1"></textarea>
                                                <button type="submit" class="btn btn-info">Comment</button>
                                        </form>
                                        <?php } else {
                                        } ?>

                                    </div>
                                </div>
                            </div>

                            <?php $sqlcomment = "SELECT * FROM comments where confirmed='1' and articleid='$id'";
                            $resultcomment = mysqli_query($link, $sqlcomment);
                            ?>
                            <?php
                            session_start();
                            $i = 0;

                            while ($comment = mysqli_fetch_array($resultcomment)) {
                                $i++;
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img class="comment-img rounded-circle"
                                             src="https://robohash.org/<?php echo $comment['username'] ?>">
                                        <div class="comment-container d-inline-block pl-3 align-top">
                                            <span class="commenter-name"><?php echo $comment['username'] ?></span>
                                            <br>
                                            <span class="comment"><?php echo $comment['content'] ?></span>
                                            <p><a href="login.php">Reply</a></p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $i = $_SESSION['i'];
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php require 'Layout/footer.php' ?>