<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
$sql = "Select * FROM article";
$result = mysqli_query($link, $sql);

session_start();

if (isset($_SESSION['user_type']) != 'admin') {

    header('location: ../index.php');
}
?>
<?php require 'layout/header.php';
require 'layout/sidebar.php';
?>

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
                                <th>title</th>
                                <th>author</th>
                                <th>createdAt</th>
                                <th>content</th>
                                <th>updateAt</th>
                                <th>tag</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>author</th>
                                <th>createdAt</th>
                                <th>content</th>
                                <th>updateAt</th>
                                <th>tag</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {

                                $detay = $row['content'];
                                $uzunluk = strlen($detay);
                                $limit = 50;
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['createdAt']; ?></td>
                                    <td><?php
                                        if ($uzunluk > $limit) {
                                            $detay = substr($detay, 0, $limit);
                                        }
                                        echo $detay;
                                        ?></td>
                                    <td><?php echo $row['updateAt']; ?></td>
                                    <td><?php echo $row['tag']; ?></td>
                                    <td><a href="editarticle.php?id=<?php echo $row['id'] ?>">edit</a></td>
                                    <td><a href="conf/articleupdate.php?delete=<?php echo $row['id'] ?>">delete</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success"><a href="articlenew.php">Add New Article</button>
                </div>
            </div>
        </div>
    </div>
<?php include 'layout/footer.php'?>