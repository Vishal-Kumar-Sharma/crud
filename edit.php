<?php
    include "conn.php";

    $id =$_GET['edit'];
    
    $sql ="SELECT * FROM client WHERE ID ='$id'";
    $query=$conn->query($sql);
    $row =$query->fetch_assoc();
?>

<form action="update.php" method="post">
    <table width="100%">
    <tr>
            <td>ID NUMBER</td>
            <td><input type="text" value="<?=$row['ID'];?>" name="ID" required readonly></td>
        </tr>
        <tr>
            <td>FIRST NAME</td>
            <td><input type="text" value="<?=$row['FNAME'];?>" name="FNAME" required></td>
        </tr>
        <tr>
            <td>MI</td>
            <td><input type="text" value="<?=$row['MI'];?>" name="MI" required></td>
        </tr>
        <tr>
            <td>LAST NAME</td>
            <td><input type="text" value="<?=$row['LNAME'];?>" name="LNAME" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submit">UPDATE</button></td>
        </tr>
    </table>
</form>