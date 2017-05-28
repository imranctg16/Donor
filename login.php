
<?php
include 'Basic_structure/header.php';
?>



<body>
<?php
include 'Basic_structure/navbar.php';
?>
<?php
if(!isset($_SESSION['user_name']))
{
    user_login();
}
else
{
        header('Location: index.php');
}
?>
</body>

<?php
include 'Basic_structure/footer.php';
?>

