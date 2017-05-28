<?php
include 'Basic_structure/header.php'
?>
<body>
<?php
include 'Basic_structure/navbar.php';
?>
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if(is_user_logged_in())
            {
                show_user_info($_SESSION['user_id']);
            }
            else
            {
                echo "You Have to <a href='login.php'>Login</a> Or <a href='registration.php'>register</a> To use donor Site";
            }
            ?>
        </div>
    </div>
</div>
<!-- /.container -->
</body>

<!--##############################################-->
<!-- Footer Part -->
<?php
include 'Basic_structure/footer.php';
?>

