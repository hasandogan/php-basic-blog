<?php
include "conf/commentlist.php";

session_start();

if (isset($_SESSION['user_type']) != 'admin') {

    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<?php require 'layout/header.php';
require 'layout/sidebar.php';

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php require 'layout/topbar.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
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
                                   <?php }?>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success"><a href="articlenew.php">Add New Article</button>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->

    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="conf/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
