<?php
include 'connect.php';
require 'Layout/header.php';
if (!isset($_SESSION['username'])) {
    header('location: index.php');
} else {
    $username = $_SESSION['username'];
    $query = $conn->query("SELECT * FROM user where username='$username'");
    if ($query->rowCount()) {
        foreach ($query as $row) {
        };
    }
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

                    <?php
                    $query = $conn->query("SELECT * FROM comments where username='$username' and confirmed='1'");
                    if ($query->columnCount()){
                        foreach ($query as $row){
                        }

                    }
                    ?>
                    <h4><?php echo count($row)  ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
