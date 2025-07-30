<?php
include "conn.php";
session_start();

$_SESSION['userId'] = "";
$_SESSION["userName"]= "";
$_SESSION["userUname"]= "";
$_SESSION['userType']= "";
$_SESSION['userEmail']= "";
$_SESSION["userLName"] = "";
$_SESSION["userFName"] ="";

header("Location: index.php");

?>