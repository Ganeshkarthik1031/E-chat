<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("connect.php");

$msg = $_REQUEST["txtarea"];

session_start();
$userid = $_SESSION["userid"];
$date = date("g:i a");

$send = mysqli_query($conn,"INSERT INTO chattb(userid,chatbody,chatdate) VALUES('$userid','$msg','$date') ");

if($send)
{
	header("Location: home.php");
}

?>