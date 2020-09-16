<?php
include 'Layout/header.php';
if (!isset($_SESSION['username'])) {
    header('location: index.php');
} else {
    $username = $_SESSION['username'];
    $user = new User();
    $row = $user->profileResult($username);
}


?>
<link rel="stylesheet" href="../css/account.css">
<div class="container">
    <div class="row user-menu-container square">
        <div class="col-md-12 user-details">
            <div class="row spacepurplebg white">
                <div class="col-md-2 no-pad">
                    <div class="user-image">
                        <img src="https://robohash.org/<?php echo $username ?>"
                             class="img-responsive thumbnail">
                    </div>
                </div>
                <div class="col-md-10 no-pad">
                    <div class="user-pad">
                        <h3>Welcome back, <?php echo $username ?> </h3>

                        <h4 class="white"><i class="fa fa-twitter"></i></h4>

                        <a class="btn btn-labeled btn-info" href="#">
                            <span class="btn-label"><i class="fa fa-pencil"></i></span>Update
                        </a>
                    </div>
                </div>
            </div>
            <div class="row overview">
                <div class="col-md-4 user-pad text-center">
                    <h3>COMMENTS</h3>
                </div>
            </div>
        </div>
    </div>
        <?php
        foreach ($row as $value){
        ?>
    <div class="form-group">
        <span class="comment"><strong><a><?php echo $value['articletitle'] ?></a></strong></span>
    </div>
    <img class="comment-img rounded-circle"
         src="https://robohash.org/<?php echo $value['username'] ?>" alt="">
    <div class="comment-container d-inline-block pl-3 align-top">
        <span class="commenter-name"><?php echo $value['username'] ?></span>
        <br>
        <span class="comment"><?php echo $value['content'] ?></span>
    </div>
<?php} ?>

</div>

