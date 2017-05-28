<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 5/20/2017
 * Time: 7:54 PM
 */

if(isset($_POST['get_option']))
{
//    $host = 'localhost';
//    $user = 'root';
//    $pass = '';
//    mysql_connect($host, $user, $pass);
//    mysql_select_db('demo');
//
//    $state = $_POST['get_option'];
//    $find=mysql_query("select city from places where state='$state'");
//    while($row=mysql_fetch_array($find))
//    {
//        echo "<option>".$row['city']."</option>";
//    }
    echo "<option>testing purpose </option>";
    exit;
}



?>
<script type="text/javascript">

    function fetch_select(val)
    {
        $.ajax({
            type: 'post',
            url: 'dynamic_change_test.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById("second-choice").innerHTML=response;
            }
        });
    }

</script>


<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<p>Current Status:
    <select id="first-choice" name="status_current" onchange="fetch_select(this.value);" >
        <option selected value="">Please Select</option>
        <option value="A">Associate</option>
        <option value="F">Family</option>
        <option value="R">Regular</option>
        <option value="RF">Regular Family</option>
        <option value="H">Honary</option>
        <option value="I">Institutional</option>
    </select>

    <select id="second-choice">
        <option>Please choose from above</option>
    </select>


