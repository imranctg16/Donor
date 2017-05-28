<!--Header Part-->
<?php
include 'Basic_structure/header.php';
?>


<body>
<?php
include 'Basic_structure/navbar.php';
?>


<div class="container">
    <div class="container-fluid">
        <?php
        if(isset($_SESSION['user_name']))
        {
            user_logout();
        }
        ?>
        <h2><a href="login.php">login ?</a></h2>
    </div>
</div>
</body>


<?php
include 'Basic_structure/footer.php';
?>


