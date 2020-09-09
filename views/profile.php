<?php
require 'Layout/header.php';
if (!isset($_SESSION['username'])) {
    header('location: index.php');
} else {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user where username='$username'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
}
?>
<link rel="stylesheet" href="../css/account.css">
<div class="container">
    <div class="row user-menu-container square">
        <div class="col-md-12 user-details">
            <div class="row spacepurplebg white">
                <div class="col-md-2 no-pad">
                    <div class="user-image">
                        <img src="https://robohash.org/<?php echo $_SESSION['username'] ?>"
                             class="img-responsive thumbnail">
                    </div>
                </div>
                <div class="col-md-10 no-pad">
                    <div class="user-pad">
                        <h3>Welcome back, <?php echo $row['username'] ?> </h3>

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

                    <?php $sql = "SELECT * FROM comments where username='$username' and confirmed='1'";
                    $result = mysqli_query($link, $sql);
                    $rownum = mysqli_num_rows($result);
                    ?>
                    <h4><?php echo $rownum ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
