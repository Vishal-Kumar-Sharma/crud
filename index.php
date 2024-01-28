<?php
    include "conn.php";
?>
<style>
    body{
        background-attachment: fixed;
        background-color:#eee;
        font-family:century gothic;
    }
    #divheader{
        margin:auto;
        width:500px;
        border-radius:3px;
        padding:10px;
        background:#fff;
    }
    input[type=text]{
        width:100%;
    }

    #table{
        border-collapse:collapse;
        padding: 5px;
    }
    tr td{
        padding: 5px;
    }
    button[type=submit]{
        padding: 10px;
        background:rgba(106, 176, 76,1.0);
        color:#fff;
        border-radius:3px;
        border:1px solid green;
        cursor: pointer;
    }
    button[type=submit]:hover{
        background:rgba(0, 148, 50,1.0);
    }
</style>
<html>
    <head>
        <title>CRUD operation</title>
    </head>
    <body>
        <div id="divheader">
            <form action="insert.php" method="post">
                <table width="100%">
                    <tr>
                        <td>FIRST NAME</td>
                        <td><input type="text" name="FNAME" required></td>
                    </tr>
                    <!-- <tr>
                        <td>MI</td>
                        <td><input type="text" name="MI" required></td>
                    </tr> -->
                    <tr>
                        <td>LAST NAME</td>
                        <td><input type="text" name="LNAME" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="submit">REGISTER</button></td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_SESSION['success'])){
                    echo  "<div style='background:green;color:#fff;padding:3px;border-radius:3px'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['error'])){
                    echo  "<div style='background:red;color:#fff;padding:3px;border-radius:3px'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
            ?>
        <br>
            <table border="1" width="100%" id="table">
                <tr style="background:rgba(0, 148, 50,1.0);color:#fff">
                    <th align="left">FIRST NAME</th>
                    <th align="left">MI</th>
                    <th align="left">LAST NAME</th>
                    <th align="right">ACTIONS</th>
                </tr>
                <?php
                    $sql ="SELECT * FROM client ORDER BY LNAME ASC";
                    $query =$conn->query($sql);
                    while($row=$query->fetch_assoc()){

                ?>
                <tr>
                    <td><?=$row['FNAME'];?></td>
                    <td><?=$row['MI'];?></td>
                    <td><?=$row['LNAME'];?></td>
                    <td align="right">
                        <a href="edit.php?edit=<?=$row['ID'];?>">EDIT</a>
                        <a href="delete.php?delete=<?=$row['ID'];?>">DELETE</a>
                    </td>
                </tr>

                <?php } ?>
            </table>
        </div>
    </body>
</html>