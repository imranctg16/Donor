<!--Header Part-->

<?php
include_once 'Basic_structure/header.php'
?>

<!--##############################################-->
<!-- Code Part -->

<body>
<?php
include 'Basic_structure/navbar.php';
?>

<body>
<!-- Page Content -->

<div class="container-fluid">

    <div class="well col-md-12 col-md-offset-0">

        <?php
        if (is_user_logged_in()) {
            blood_search();
        } else {
            echo "You Have to <a href='login.php'>Login</a> Or <a href='registration.php'>register</a> To use donor Site";
        }
        ?>
    </div>

</div>
<!-- /.container -->
</body>


<!--##############################################-->
<!-- Footer Part -->
<?php
include_once 'Basic_structure/footer.php'
?>



