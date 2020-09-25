<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
require 'adminlayout/topbar.php';
$comment = new CommentController();
$commentList = $comment->list();

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

                            if (count($commentList['comment'])) {

                                /** @var \src\entity\Comments $row */
                                foreach ($commentList['comment'] as $row) {
                                    $date = $row->getCreatedat();
                                    $dateTime = $date->format('Y-m-d H:i:s');
                                    $timeAgo = $comment->timeAgo(strtotime($dateTime));

                                    ?>
                                    <tr>
                                        <td><?php echo $row->getId(); ?></td>
                                        <td><?php echo $row->getUsername(); ?></td>
                                        <td><?php echo $row->getContent(); ?></td>
                                        <td><?php echo $row->getArticleid(); ?></td>
                                        <td>
                                            <a href="/article/<?php echo $row->getArticletitle(); ?>"><?php echo $row->getArticletitle(); ?></a>
                                        </td>
                                        <td><?php echo $timeAgo; ?></td>
                                        <td><?php if ($row->getConfirmed() == 1) { ?>
                                                <i class="fa fa-check"></i><?php } else { ?>
                                                <i class="fas fa-times"></i>
                                            <?php } ?>
                                        </td>
                                        <td><a href="Delete-comment/<?php echo $row->getId(); ?>">delete</a></td>
                                        <?php if ($row->getConfirmed() == 0) {
                                            ?>
                                            <td><a href="confirm-comment/<?php echo $row->getId(); ?>">confirm</a></td>
                                        <?php } else { ?>
                                            <td>Already confirmed</td>

                                        <?php } ?>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'adminlayout/footer.php' ?>