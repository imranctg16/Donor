<?php
/**
 * Created by PhpStorm.
 * User: Imran
 * Date: 5/4/2017
 * Time: 9:55 AM
 */
session_start();

if(!isset($_SESSION['user_name']))
{
    if(isset($_COOKIE['user_name'])&& isset($_COOKIE['user_id']))
    {
        $_SESSION['user_name']=$_COOKIE['user_name'];
        $_SESSION['user_id']=$_COOKIE['user_id'];
    }
}
ob_start();
include "./classes.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logo Nav - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href=".css/bootstrap.min.css" rel="stylesheet">
-->
    <link rel="stylesheet" href="./assests/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="./assests/css/logo-nav.css" rel="stylesheet">


</head>

