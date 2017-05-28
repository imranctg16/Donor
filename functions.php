<?php
function show_all_user()
{
    $sql = "SELECT * FROM Users";
    $connection_obj = new Connection();
    $result = $connection_obj->mysqli->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['user_name'] . "<br>";
    }
}

?>


<?php
function show_reg_form()
{
    $name_error = "";
    $email_error = "";
    $passward_error = "";
    $user_name = "";
    $user_email = "";
    $user_passward = "";
    if (isset($_POST['reg_submit'])) {

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_passward = $_POST['user_password'];
        /**
         * Validation for register_forn
         */
        if ($user_name == "" || $user_email == "" || $user_passward == "") {

            if ($user_name == '') {
                $name_error = "You Forgot to fill out Username field";
            }
            if ($user_email == '') {
                $email_error = "You Forgot to fill out Email field";
            }
            if ($user_passward == '') {
                $passward_error = "You Forgot to fill out passward field";
            }
        } else {
            $user_obj = new Users;
            $user_obj->create_user($user_name, $user_passward, $user_email);
            echo "USER successfully Created";
        }
    }
    ?>
    <div class="col-xs-12 col-xs-offset-3">
        <div class="form-wrap">
            <h1>Register</h1>
            <form role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="login-form" autocomplete="off">
                <div class="text-center text-danger"></div>
                <div class="form-group">
                    <?php if ($name_error != "") {
                        echo "<label for='user_name' class='text-center text-danger'>$name_error</label>";
                    }
                    ?>
                    <label for="user_name" class="sr-only">username</label>
                    <input type="text" name="user_name" value="<?php if ($user_name != '') echo $user_name; ?>"
                           id="username" class="form-control"
                           placeholder="Enter Desired Username">
                </div>
                <div class="form-group">
                    <?php if ($email_error != "") {
                        echo "<label for='user_name' class='text-center text-danger'>$email_error</label>";
                    }
                    ?>
                    <label for="user_email" class="sr-only">Email</label>
                    <input value="<?php if ($user_email != '') {
                        echo $user_email;
                    } ?>" type="email" name="user_email" id="email" class="form-control"
                           placeholder="somebody@example.com">
                </div>
                <div class="form-group">
                    <?php if ($passward_error != "") {
                        echo "<label for='user_name' class='text-center text-danger'>$passward_error</label>";
                    }
                    ?>
                    <label for="user_password" class="sr-only">Password</label>
                    <input value="<?php if ($user_passward != '') echo $user_passward; ?>" type="password"
                           name="user_password" id="key" class="form-control"
                           placeholder="Password">
                </div>
                <input type="submit" name="reg_submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                       value="Register">
            </form>
        </div>
    </div>
    <?php
}

?>

<?php
function user_login()
{

    echo "<div class='well '>";
    if (!isset($_SESSION['user_name'])) {

        if (isset($_POST['login_submit'])) {
            $user_email = $_POST['user_email'];
            $user_passward = $_POST['user_passward'];
            $user_obj = new Users;
            $user_obj->login_user($user_email, $user_passward);
        }
        ?>

        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <label for="user_email">Your Email</label>
                <input type="email" class="form-control" name="user_email" placeholder="Enter User Email">
            </div>
            <div class="form-group">
                <label for="user_passward">Your Passward</label>
                <input type="password" class="form-control" name="user_passward" placeholder="Enter Passward">
                <span class="input-group-btn">
                    <button name="login_submit" type="submit" class="btn btn-primary">Submit</button>
                </span>
            </div>
        </form>
        <!-- /Login -->

    <?php } else {
        echo "Already Logged in";
    }
}

?>


<?php
function user_logout()
{
    $_SESSION = array();
    setcookie(session_name(), '', time() - 3600);
    session_destroy();
    header('Location: login.php');
}

?>


<?php
/**
 * It calls Show_result_table function
 *
 */
function blood_search()
{
    $division_obj = new Division;
    $blood_group_obj = new Blood_group;
    $data_obj = new Data;
    if (isset($_POST['submit_search'])) {

        $division_obj = new Division;
        $blood_group_obj = new Blood_group;
        $data_obj = new Data;

        $blood_group_id = $_POST['blood_group'];
        $division_id = $_POST['division'];
        //echo $blood_group_id . " and  " . $division_id;
        $all_data = $data_obj->get_data($division_id, $blood_group_id);
        $all_data=serialize($all_data);

        header("Location: show_result.php?all_data=".$all_data);

    }
    ?>
    <form class="" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

        <div class="form-group">
            <label for="division">Select A Division</label>
            <select name="division" id="">
                <?php
                $all_division = $division_obj->get_all_div();
                while ($row = mysqli_fetch_assoc($all_division)) {
                    $division_name = $row['division_name'];
                    $division_id = $row['division_id'];
                    echo "<option value='{$division_id}'>$division_name</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="blood_group">Select A Blood Group </label>
            <select name="blood_group" id="">
                <?php
                $all_blood = $blood_group_obj->get_all_group();
                while ($row = mysqli_fetch_assoc($all_blood)) {
                    $blood_group_name = $row['blood_group_name'];
                    $blood_group_id = $row['blood_group_id'];
                    echo "<option value='{$blood_group_id}'>$blood_group_name</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" name="submit_search" class="btn btn-primary" value="Search">;
    </form>
    <?php
}

?>

<?php
function is_user_logged_in()
{
    if (isset($_SESSION['user_name'])) {
        return true;
    } else {
        return false;
    }
}
?>

<?php
function show_donor_form()
{

    ///class_variable
    $user_obj = new Users;
    $division_obj = new Division;
    $blood_group_obj = new Blood_group;
    $data_obj = new Data;
    ///error_variable
    $image_error = "";
    $number_error = "";
    $date_error = "";
    ///useful_variable
    $last_donate = "";
    $user_image = "";
    $user_number = "";

    if (isset($_POST['submit_donor'])) {
        $user_id = $_SESSION['user_id'];
        $user_exist_in_data = $data_obj->is_user_exist_in_data($user_id);
        if ($user_exist_in_data) {
            exit("Already In Donor List");
        }
        $user_name = $user_obj->get_user_name($user_id);
        $blood_group_id = $_POST['blood_group'];
        $division_id = $_POST['division'];
        $user_number = $_POST['user_number'];
        //$last_donate = date('Y-m-d', strtotime($_POST['last_donate']));
        //date_validation
        if (strtotime($_POST['last_donate'])) { # date validation
            $last_donate = date('Y-m-d', strtotime($_POST['last_donate']));
        } else {
            $date_error = "Select a date ";
        }
        //number_validation
        if ($user_number == "") {
            $number_error = "Provide a Contact number";
        }
        //ImageValidation ,source= w3school.com
        $target_dir = "images/";
        $user_image = $_FILES['user_image']['name'];
        $target_file = $target_dir . basename($user_image);
        $user_image_temp = "";
        if ($user_image) {
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        }

        if ($user_image_temp) {
            $check = getimagesize($user_image_temp);
            if ($check !== false) {
                //  echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $image_error .= "File is not an image.";
                $uploadOk = 0;
            }
            /*
                        if (file_exists($target_file)) {
                            //echo "Sorry, file already exists.";
                            $image_error .= "Sorry, file already exists.";
                            $uploadOk = 0;
                        }*/

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $image_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                //echo "Sorry, your file was not uploaded.";
                $image_error .= "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($user_image_temp, $target_file)) {
                    //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $image_error = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $image_error = "No Image was Selected";
        }
        echo $user_id . " " . $user_name . "<br>";
        echo $blood_group_id . " and " . $division_id . "<br>";
        echo $user_number . " and " . $last_donate . "<br>";
        if ($number_error == "" && $image_error == "" && $date_error == "") {
            $success = $data_obj->save_data($user_id, $division_id, $blood_group_id, $user_image, $user_number, $last_donate);
            if ($success) {
                echo "Successfully Saved Data";
            } else {
                echo "Something Went Wrong in Saving data";
            }
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <div class="form-group">
                <label for="division">Select Your Division</label>
                <select name="division" id="">
                    <?php
                    $all_division = $division_obj->get_all_div();
                    while ($row = mysqli_fetch_assoc($all_division)) {
                        $division_name = $row['division_name'];
                        $division_id = $row['division_id'];
                        echo "<option value='{$division_id}'>$division_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="blood_group">Select Your Blood Group</label>
                <select name="blood_group" id="">
                    <?php
                    $all_blood = $blood_group_obj->get_all_group();
                    while ($row = mysqli_fetch_assoc($all_blood)) {
                        $blood_group_name = $row['blood_group_name'];
                        $blood_group_id = $row['blood_group_id'];
                        echo "<option value='{$blood_group_id}'>$blood_group_name</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <?php if ($image_error != "") {
                echo "<label  for='user_image' class='text-center text-danger'>$image_error</label>";
            } else {
                echo '<label for="user_image">Your image:</label>';
            }
            ?>
            <input class="form-control" name="user_image" type="file">
        </div>
        <div class="form-group">
            <?php if ($number_error != "") {
                echo "<label  for='user_number' class='text-center text-danger'>$number_error</label>";
            } else {
                echo '<label for="user_number">Your cell number</label>';
            }
            ?>
            <input value="<?php if ($user_number != '') echo $user_number; ?>" class="form-control" name="user_number"
                   type="text">
        </div>
        <div class="form-group">
            <?php if ($date_error != "") {
                echo "<label  for='last_donate' class='text-center text-danger'>$date_error</label>";
            } else {
                echo "<label for='last_donate'>When did You last Donated ? (pick a date)</label>";
            }
            ?>
            <input value="<?php if ($last_donate != '') echo $last_donate; ?>" class="form-control" name="last_donate"
                   type="date" min="2017-01-01">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit_donor" value="Done">
        </div>
    </form>
    <?php
}

?>

<?php
/**
 * @param $all_data
 * Part Of BLood_Search Function
 */
function show_result_table($all_data)
{
    $user_obj = new Users;
    $division_obj = new Division;
    $blood_group_obj = new Blood_group;
    $data_obj = new Data;
    echo "Total" . mysqli_num_rows($all_data) . " result found";
    ?>
    <div class="col-md-12">
        <table class=" table table-bordered table-responsive table-hover">
        <thead>
        <tr>
            <th> Name</th>
            <th> Division</th>
            <th> Blood Group</th>
            <th> Image</th>
            <th> Number</th>
            <th> Last Donated</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($all_data)) {
            $user_id = $row['user_id'];
            $user_name = $user_obj->get_user_name($user_id);
            $blood_group_id = $row['blood_group_id'];
            $blood_group_name = $blood_group_obj->get_blood_group_name($blood_group_id);
            $division_id = $row['division_id'];
            $division_name = $division_obj->get_division_name($division_id);
            $user_number = $row['user_number'];
            $user_image = $row['user_picture'];
            $last_donate = $row['last_donate'];
            $last_donate = strtotime($last_donate);
            $current_date = time();
            $day_diff = $current_date - $last_donate;
            $day_diff = floor($day_diff / (60 * 60 * 24));
            echo "<tr>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$division_name}</td>";
            echo "<td>{$blood_group_name}</td>";
            echo "<td><img class='img-responsive' width='100' src='images/{$user_image}'></td>";
            echo "<td>{$user_number}</td>";
            echo "<td>{$day_diff} day ago </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    <?php
} ?>

<?php
function show_user_info($user_id)
{

    $user_obj = new Users;
    $division_obj = new Division;
    $blood_group_obj = new Blood_group;
    $data_obj = new Data;

    //from user table
    $user_table_data = $user_obj->get_user_data($user_id);

    //show_user_table_data
    while ($row = mysqli_fetch_assoc($user_table_data)) {
        echo "<div class=well>";
        echo "<h3> <strong>User Name </strong> = " . $row['user_name'] . "</h3>";
        echo "<h3> <strong>ser Email : </strong> = " . $row['user_email'] . "</h3>";
        echo "<h3> <strong>Joined :</strong> = " . $row['user_joined'] . "</h3>";
        echo "</div>";
    }
    if (is_a_donor($user_id)) {
        $rest_data = $data_obj->get_data_on_user($user_id);
        while ($row = mysqli_fetch_assoc($rest_data)) {
            $user_number = $row['user_number'];
            $user_blood_group_id = $row['blood_group_id'];
            $user_picture = $row['user_picture'];
            $last_donated = $row['last_donate'];
        }
        echo "<div class=well>";
        echo "<h3> <strong>Number</strong> = " . $user_number . "</h3>";
        echo "<h3> <strong>Blood Group</strong> = " . $blood_group_obj->get_blood_group_name($user_blood_group_id) . "</h3>";
        echo "<h3> <strong>Donor Image </strong> <img class='img-responsive' width='100' src='images/{$user_picture}'> </h3>";
        echo "<h3> <strong>last_donated</strong> = " . $last_donated . "</h3>";
        echo "</div>";
    }
}

?>

<?php
/**
 * @param $user_id
 * @return bool
 * Called in Profile page->show_user_info (function)
 */
function is_a_donor($user_id)
{
    $data_obj = new Data;
    if ($data_obj->is_user_exist_in_data($user_id)) {
        return true;
    } else {
        return false;
    }
}

?>

