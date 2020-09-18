<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
$categories = new Categories();
$categories = $categories->list();
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
if (isset($_SESSION['basariliguncelleme'])){ ?>
    <div class="alert alert-success" role="alert">
        Kayıt Güncellendi!
    </div>
    <?php
    unset($_SESSION['basariliguncelleme']);
}
?>
    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'adminlayout/topbar.php' ?>
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
                            if ($categories['totalCount']>0){
                                foreach ($categories['category'] as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['page_title'] ?></td>
                                        <td><?php echo $row['content'] ?></td>
                                        <td><?php echo $row['meta_desc'] ?></td>
                                        <td><?php echo $row['meta_key'] ?></td>
                                        <td><a href="view-edit-categories/<?php echo $row['id'] ?>">edit</a></td>
                                        <td><a href="deletecategories/<?php echo $row['id'] ?>">delete</a></td>
                                    </tr>
                                <?php
                            }} ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success"><a href="view-add-categories">Add New categories</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php include 'adminlayout/footer.php' ?>