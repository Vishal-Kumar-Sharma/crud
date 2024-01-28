<?php
include "conn.php";

$id= $_GET['delete'];

$sql ="DELETE FROM client WHERE ID='$id'";

if($conn->query($sql)){
    $_SESSION['success']="Record Successfully Delete";
}else{
    $_SESSION['error']="No record deleted";
}

header("location:index.php");
?>