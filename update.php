<?php
    include "conn.php";

    if(isset($_POST['submit'])){
        $ID =$_POST['ID'];
        $FNAME =$_POST['FNAME'];
        $MI=$_POST['MI'];
        $LNAME=$_POST['LNAME'];

        $sql ="UPDATE client SET FNAME='$FNAME', MI='$MI', LNAME='$LNAME' WHERE ID='$ID'";

        if($conn->query($sql)){
            $_SESSION['success']="Record successfully updated";
        }else{
            $_SESSION['error']="No record updated";
        }

    }
    header("location:index.php");
?>