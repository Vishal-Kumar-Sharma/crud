<?php
include "conn.php";

$emp_no= $_GET['emp_no'];

$sql ="DELETE FROM register WHERE emp_no='$emp_no'";


if($conn->query($sql)){
    // $_SESSION['success']="Record Successfully Delete";
    header("location:display.php");
}else{
    $_SESSION['error']="No record deleted";
}

?>