<?php
include 'conf/connect.php';
require 'layout/header.php';
require 'layout/sidebar.php';
$query = $conn->query("SELECT * FROM categories");

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
                                <th>name</th>
                                <th>pagetitle</th>
                                <th>content</th>
                                <th>metadesc</th>
                                <th>metakey</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>pagetitle</th>
                                <th>content</th>
                                <th>metadesc</th>
                                <th>metakey</th>
                                <th>edit</th>
                                <th>delete</th>

                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if ($query->rowCount()) {
                                foreach ($query as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['page_title'] ?></td>
                                        <td><?php echo $row['content'] ?></td>
                                        <td><?php echo $row['meta_desc'] ?></td>
                                        <td><?php echo $row['meta_key'] ?></td>
                                        <td><a href="editcategories/<?php echo $row['id'] ?>">edit</a></td>
                                        <td><a href="categoriesedit/delete/<?php echo $row['id'] ?>">delete</a></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success"><a href="/admin/categoriesadd">Add New categories</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php include 'layout/footer.php' ?>