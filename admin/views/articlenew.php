<?php
require 'layout/sidebar.php';
require 'layout/header.php';
include 'conf/connect.php';
$query = $conn->query("SELECT * FROM categories");
?>
<body>
    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'layout/topbar.php'; ?>
        <form action="/admin/artice/edit/1" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">title</label>
                <input type="text" class="form-control" name="title" placeholder="title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">author</label>
                <input type="text" class="form-control" name="author" placeholder="author">
            </div>
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
                    <?php if ($query->rowCount()){
                        foreach ($query as $row){ ?>
                        <option><?php echo $row['name']?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit"  class="btn btn-info" />
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

    <script>
        $('.select2').select2({
            data: ["space", "road", "earth"],
            tags: true,
            maximumSelectionLength: 10,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type keywords",
            //minimumInputLength: 1,
            //ajax: {
            //   url: "you url to data",
            //   dataType: 'json',
            //  quietMillis: 250,
            //  data: function (term, page) {
            //     return {
            //         q: term, // search term
            //    };
            //  },
            //  results: function (data, page) {
            //  return { results: data.items };
            //   },
            //   cache: true
            // }
        });
    </script>
    </body>

    </html>
