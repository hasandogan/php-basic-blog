<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];
$comment = new CommentController();
$comment = $comment->list();
$article = new ArticleController();
$article = $article->list();
$user = new UserController();
$user = $user->list();
$admin = new AdminController();
$admin = $admin->list();
$categories = new CategoriesController();
$categories = $categories->list();


?>

<?php require 'adminlayout/topbar.php'; ?>

<?php
if (isset($_SESSION['admingiris'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Tekrar Hoşgeldin! <?php echo $name . " " . $lastname ?> </h4>
        <p>Başarılı bir giriş yaptın. Harika makaleler ve diğer işlerini yapmak için harika bir gün!</p>
        <hr>
        <p class="mb-0">Her ne yapıyorsan, devam et!</p>
    </div>

    <?php
    unset($_SESSION['admingiris']);
}
?>
    <div class="card-group">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Yorum
                                Sayısı
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($comment['comment']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-8 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Makale Sayısı
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($article['article']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pager fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-8 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Kullanıcı
                                Sayısı
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($user['user']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-8 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Yönetici
                                Sayısı
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($admin['admin']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-chart-area fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-8 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam Kategory
                                Sayısı
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($categories['category']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-copy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require 'Layout/footer.php'; ?>