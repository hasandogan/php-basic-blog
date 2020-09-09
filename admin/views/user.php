<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
$sql = "Select * From user";
$result = mysqli_query($link, $sql);
session_start();
if (isset($_SESSION['user_type']) != 'admin') {
    header('location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<?php require 'layout/header.php';
require 'layout/sidebar.php';
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'layout/topbar.php' ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Articles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <tr>
                                <th>id</th>
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>username</th>
                                <th>email</th>
                                <th>pass</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>username</th>
                                <th>email</th>
                                <th>pass</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {

                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['pass']; ?></td>
                                    <td><a href="useredit.php?id=<?php echo $row['id'] ?>">todo</a></td>
                                    <td><a href="conf/userconf.php?id=<?php echo $row['id'] ?>">todo</a></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success"><a href="newuser">Add New User</button>
                </div>
            </div>
        </div>
    </div>
<?php require 'layout/footer.php' ?>