<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
?>

<form class="user" action="adminadd" method="POST">
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="username"
               id="exampleInputEmail" aria-describedby="username"
               placeholder="Enter username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user" name="password"
               placeholder="Enter password">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="name"
               placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" name="usertype">
                    <option>admin</option>
        </select>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="lastname"
               placeholder="Enter Lastname">
    </div>
    <button type="submit" name="submit" class="btn btn-success">Success</button>
    <hr>
</form>
<?php include 'Layout/footer.php' ?>