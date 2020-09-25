<?php
$request = urldecode($_SERVER['REQUEST_URI']);
$path = substr($request, 1);
$pathArray = explode('/', $path);
$id = $pathArray[2];
if (isset($id)) {
   $article =  new ArticleController();
   $article = $article->list($id);
    $row =  $article['article'][0];
} else {
    header('location article');
}
?>
<?php require 'adminlayout/header.php' ?>
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php require 'adminlayout/sidebar.php';
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'adminlayout/topbar.php'; ?>
        <form action="/admin/update-article" method="post" enctype="multipart/form-data">
            <input type="hidden"  name="id" value="<?php echo $row->getId() ?>">
            <div class="form-group">
                <label for="exampleFormControlInput1">title</label>
                <input type="text" class="form-control" value="<?php echo $row->getTitle() ?>" name="title"
                       placeholder="title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">author</label>
                <input type="text" class="form-control" name="author" value="<?php echo $row->getAuthor() ?>"
                       placeholder="author">
            </div>
            <div class="form-group">

                <img src="../../img/<?php echo $row->getImagePath() ?>" alt="Girl in a jacket" width="100" height="100">
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea name="content" ><?php echo $row->getContent() ?></textarea>

            </div>
            <?php
                    $category = new CategoriesController();
                    $category = $category->list();
                    $categories = $category['category'];
            ?>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" name="categories">
                    <?php
                    /** @var \src\entity\Categories $row */
                    if (count($category)>0) {
                        foreach ($categories as $row) {?>
                    <option><?php echo $row->getName() ?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit"  class="btn btn-info" />
            </div>
        </form>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <?php require 'adminlayout/footer.php'?>

