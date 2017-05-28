<?php
include 'Basic_structure/header.php'
?>

<?php
   if(isset($_GET['delete']))
   {
       $data_obj=new Data;
       echo"You asked to Remove yourself from the donor list";
       $result=$data_obj->delete_user($_SESSION['user_id']);
       if($result)
       {
           echo "<h3>Successfully deleted User</h3>";
       }
       else
       {
           echo "<h3>Couldnt Delete the user</h3>";
       }
   }
?>
<body>
<?php
include 'Basic_structure/navbar.php';
?>
<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <title>Welcome To Donor Website</title>
            <?php
            if(is_user_logged_in())
            {
                $data_obj=new Data;
                if($data_obj->is_user_exist_in_data($_SESSION['user_id']))
                {
                   echo '<div class="alert alert-success">';
                    echo "<h3>Already Listed On Donor list </h3>";
                   echo "</div>";
                    echo "  <h1><a class='btn btn-danger' href='add_donor.php?delete={$_SESSION['user_id']}'>Undo ?</a></h1>";

                }
                else
                {
                    show_donor_form();

                }
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
<!-- Footer Part -->
<?php
include 'Basic_structure/footer.php';
?>


