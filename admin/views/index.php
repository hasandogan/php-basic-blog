<?php
require 'layout/header.php';
require 'layout/sidebar.php';
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];
?>

    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
<?php require 'layout/topbar.php'; ?>
    <div class="container-fluid">
    <div class="row">
    </div>
<?php
if (isset($_SESSION['admingiris'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Tekrar Hoşgeldin! <?php echo $name." ".$lastname ?> </h4>
        <p>Başarılı bir giriş yaptın. Harika makaleler ve diğer işlerini yapmak için harika bir gün!</p>
        <hr>
        <p class="mb-0">Her ne yapıyorsan, devam et!</p>
    </div>

    <?php
    unset($_SESSION['admingiris']);
}
?>

<?php require 'layout/footer.php'; ?>