<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
$sql = "Select * FROM admin";
$result = mysqli_query($link, $sql);


?>
<?php require 'layout/header.php';
require 'layout/sidebar.php';
require 'layout/topbar.php'
?>
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
                            <th>username</th>
                            <th>password</th>
                            <th>user_type</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>password</th>
                            <th>user_type</th>
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
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['user_type']; ?></td>
                                <td><a href="editarticle/<?php echo $row['id'] ?>">edit</a></td>
                                <td><a href="../conf/articleupdate.php?delete=<?php echo $row['id'] ?>">delete</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php include 'layout/footer.php' ?>