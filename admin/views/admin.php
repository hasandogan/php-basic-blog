<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
require 'adminlayout/topbar.php';
$admin = new Admin();
$admin = $admin->list();
if (isset($_SESSION['basarilikayit'])){ ?>
    <div class="alert alert-success" role="alert">
        Kayıt başarıyla Oluşturuldu!
    </div>
    <?php
    unset($_SESSION['basarilikayit']);
}
if (isset($_SESSION['basarilisilme'])){ ?>
    <div class="alert alert-success" role="alert">
        Kayıt Başarıyla silindi!
    </div>
<?php
    unset($_SESSION['basarilisilme']);
}
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
                            <th>Username</th>
                            <th>Usertype</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Usertype</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        if ($admin['totalCount']>0) {
                            foreach ($admin['admin'] as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['user_type']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><a href="delete-admin/<?php echo $row['id'] ?>">delete</a></td>
                                </tr>
                            <?php }
                        } ?>

                        </tbody>

                    </table>
                    <a href="view-adminadd"> <button type="button" class="btn btn-success">Add New Admin</button></a>
                </div>

            </div>
        </div>
    </div>
    </div>
<?php include 'adminlayout/footer.php' ?>