<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
$categories = new CategoriesController();
$categories = $categories->list();
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'adminlayout/topbar.php'; ?>
        <form action="articledd" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">title</label>
                <input type="text" class="form-control" name="title" placeholder="title">
            </div>
            <input type="hidden" name="author" value="<?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname']; ?>">
            <div class="form-group">
                <input type="file" name="fileToUpload">
            </div>
            <label>Select Tag</label>
            <div class="form-group">
                <select class="form-control select2" name="tags[]" multiple="multiple" style="width: 100%;"></select>
            </div>
            <input type="hidden" value="add" name="add">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" name="categories">

                    <?php
                    if (count($categories['category']) > 0) {
                        foreach ($categories['category'] as $row) { ?>
                            <option><?php echo $row->getName() ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea name="content"></textarea>
                               </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-info"/>
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

    <?php
    require 'adminlayout/footer.php';
    ?>
