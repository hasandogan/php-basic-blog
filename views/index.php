<?php
require 'Layout/header.php';
?>
<div class="container">
    <div class="row">
        <?php require 'Layout/cardlayout.php' ?>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="../search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                            <span class="input-group-append">
                    <input type="submit">
                    </form>
                    </span>
                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT DISTINCT tag_name FROM tags ORDER BY tag_name DESC LIMIT 50;";
        $tagquery = mysqli_query($link, $sql);
        ?>
        <div class="card my-4">
            <h5 class="card-header">Last add Tags </h5>
            <div class="card-body">
                <?php while ($row = mysqli_fetch_array($tagquery)) {

                    ?>
                    <a href="/tag/<?php echo $row['tag_name'] ?>"> <span
                                class='badge badge-secondary'><?php echo $row['tag_name'] ?></span> </a>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container -->


<?php include 'Layout/footer.php' ?>
