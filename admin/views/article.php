<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
require 'adminlayout/topbar.php';
$article = new Article();
$article = $article->list();
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
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Article</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>slug</th>
                            <th>author</th>
                            <th>createdAt</th>
                            <th>content</th>
                            <th>updateAt</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>slug</th>
                            <th>author</th>
                            <th>createdAt</th>
                            <th>content</th>
                            <th>updateAt</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php

                        if ($article['totalCount']>0){
                            foreach ($article['article'] as $row){
                            $detay = $row['content'];
                            $uzunluk = strlen($detay);
                            $limit = 10;
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><a href="/article/<?= $row['slug']?>">
                                        <?php echo $row['slug']; ?></a></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['createdAt']; ?></td>
                                <td><?php
                                    if ($uzunluk > $limit) {
                                        $detay = Strip_tags($detay);
                                        $detay = substr($detay, 0, $limit);
                                    }
                                    echo $detay;
                                    ?></td>
                                <td><?php echo $row['updateAt']; ?></td>
                                <td><a href="editarticle/<?php echo $row['id'] ?>">edit</a></td>
                                <td><a href="delete-article/<?php echo $row['id'] ?>">delete</a></td>
                            </tr>
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>
                <a href="articlenew"> <button type="button" class="btn btn-success">Add New Article</button></a>
            </div>
        </div>
    </div>
    </div>
<?php include 'adminlayout/footer.php' ?>