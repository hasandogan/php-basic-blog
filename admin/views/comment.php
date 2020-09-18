<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
require 'adminlayout/topbar.php';
$comment = new Comment();
$comment = $comment->list();
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>content</th>
                                <th>articleid</th>
                                <th>article-slug</th>
                                <th>createdAt</th>
                                <th>confirmed</th>
                                <th>delete</th>
                                <th>confirm</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>content</th>
                                <th>articleid</th>
                                <th>article-slug</th>
                                <th>createdAt</th>
                                <th>confirmed</th>
                                <th>delete</th>
                                <th>confirm</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php

                            if ($comment['totalCount']){
                                foreach ($comment['comment'] as $row){
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['content']; ?></td>
                                    <td><?php echo $row['articleid']; ?></td>
                                    <td><a href="/articleshow/<?php echo $row['articletitle']; ?>"><?php echo $row['articletitle']; ?></a></td>
                                    <td><?php echo $row['CreatedAt']; ?></td>
                                    <td><?php if ($row['confirmed'] == 1) { ?>
                                            <i  class="">✅</i><?php } else { ?>
                                            <i class="">❗</i>
                                        <?php } ?>
                                    </td>
                                    <td><a href="Delete-comment/<?php echo $row['id']; ?>">❌</a></td>
                                    <?php if ($row['confirmed'] == 0){
                                        ?>
                                        <td><a href="confirm-comment/<?php echo $row["id"]; ?>">confirm</a></td>
                                   <?php }else{?>
                                        <td><a href="confirm-comment/<?php echo $row["id"]; ?>">✅</a></td>

                                   <?php  }?>
                                </tr>
                            <?php  }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'adminlayout/footer.php' ?>