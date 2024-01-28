<?php
    include "conn.php";

    if(isset($_POST['submit'])){
        $FNAME =$_POST['FNAME'];
        $MI =$_POST['MI'];
        $LNAME=$_POST['LNAME'];

        $sql ="INSERT INTO client (FNAME,MI,LNAME)VALUES('$FNAME','$MI','$LNAME')";
        if($conn->query($sql)){
            $_SESSION['success']="Record successfully inserted";
        }else{
            $_SESSION['error']="No record created!";
        }
    }
    header("location:index.php");
?>