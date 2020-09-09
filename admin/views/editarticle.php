<?php

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$id = $pathArray[1];

if (isset($id)) {
    include '../connect.php';
    $sql = ("SELECT * FROM article WHERE id='$id'");
    $query = mysqli_query($link, $sql);
    $result = mysqli_fetch_array($query);
}else{
    header('location article');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'layout/header.php' ?>
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<body id="page-top">
<?php require 'layout/sidebar.php';
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require 'layout/topbar.php'; ?>
        <form action="../articleupdate/<?php echo $result['id']?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">title</label>
                <input type="text" class="form-control" value="<?php echo $result['title'] ?>" name="title" placeholder="title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">author</label>
                <input type="text" class="form-control" name="author" value="<?php echo $result['author'] ?>"  placeholder="author">
            </div>
            <div class="form-group">

                <img src="../img/<?php echo $result['image_path']?>" alt="Girl in a jacket" width="100" height="100">
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <label>Select Tag</label>
            <div class="form-group">
                <select class="form-control select2"  name="tags[]" multiple="multiple" style="width: 100%;"></select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" name="content" rows="3"><?php echo $result['content']?></textarea>
            </div>
            <?php $sql = "select * from categories ";
            $result = mysqli_query($link, $sql);
            ?>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" name="categories">
                    <?php while ($row = mysqli_fetch_array($result)) {?>
                        <option><?php echo $row['categories']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit"/>
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
<?php
$sql = "SELECT * FROM tags where articleid='$id'";
$tagquery = mysqli_query($link,$sql);
$tagnamelist = [];
while ($tagrow = mysqli_fetch_array($tagquery)) {
   $tagname = $tagrow['tag_name'];
    $tagnamelist[]  = $tagname;
}
$tagnamelist = implode("  ", $tagnamelist);
?>
    <script>
        $('.select2').select2({
            data: ["space", "road", "earth"],
            tags: true,
            maximumSelectionLength: 10,
            tokenSeparators: [',', ' '],
            placeholder: "<?php echo $tagnamelist?>",
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
