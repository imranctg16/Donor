<!-- Navigation -->
<?php
//include "../url.php";
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="./index.php">Home</a></li>
                <li>
                    <a href="#">Admin</a>
                </li>
                <li><a href="./registration.php">Registration</a></li>
                <?php
                if (is_user_logged_in()){
                    ?>
                    <li><a href="./profile.php">Profile</a></li>
                    <li>
                        <a href="./add_donor.php">Become A Donor </a>
                    </li>
                    <li><a href="./logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="./login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
