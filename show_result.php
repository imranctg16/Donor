<!--Header Part-->
<?php
include 'Basic_structure/header.php'
?>

<!--##############################################-->
<!-- Code Part -->

<body>
<?php
include 'Basic_structure/navbar.php';
?>
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php
            /**
             * It is a part of blood_search function in functions.php
             * Purpose: To show the result
             * pre_data: ( $all_data ) Variable from the blood_search function
             */
            //echo  mysqli_num_rows($_SESSION['all_data']);
            if (isset($_GET['all_data'])) {
                $all_data = unserialize($_GET['all_data']); 
                if (mysqli_num_rows($all_data) > 0)
                    show_result_table($all_data);
                else {
                    echo "<p class='alert alert-danger'>SORRY NO DATA FOUND</p>";
                }
            }
            else
            {
                echo "Dude , You are doomed !";
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

