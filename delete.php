<?php
if(isset($_GET["type"]) && isset($_GET["id"])){
    require_once 'conn.php';
    $type = $_GET["type"];
    $id = $_GET["id"];
    //echo $type , $id;
    $sql ="DELETE FROM $type WHERE id = $id";
    mysqli_query($conn,$sql);
    mysqli_close($conn);
    header("Location: index.php");
    exit();
    
}
?>