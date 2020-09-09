<?php
include "conf/commentlist.php";
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
                                <th>username</th>
                                <th>content</th>
                                <th>createdAt</th>
                                <th>confirmed</th>
                                <th>articleid</th>
                                <th>delete</th>
                                <th>confirm</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>content</th>
                                <th>createdAt</th>
                                <th>confirmed</th>
                                <th>articleid</th>
                                <th>delete</th>
                                <th>confirm</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['content']; ?></td>
                                    <td><?php echo $row['CreatedAt']; ?></td>
                                    <td><?php if ($row['confirmed'] == 1) { ?>
                                            <i class="fas fa-check"></i><?php } else { ?>
                                            <i class="fas fa-times"></i>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $row['articleid']; ?></td>
                                    <td><a href="conf/commentlist.php?delete=<?php echo $row['id']; ?>">delete</a></td>
                                    <?php if ($row['confirmed'] == 0){
                                        ?>
                                        <td><a href="conf/commentlist.php?id=<?php echo $row["id"]; ?>">confirm</a></td>
                                   <?php }else{}?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'Layout/footer.php';