<?php
include "conn.php";

    
    $sql ="SELECT emp_no,emp_name,address,s.s_name,c.c_name,pincode,mobile,email,photo FROM register r,city c,state s where c.c_id=r.city and s.s_id=c.s_id and r.state=s.s_id";
    $rs = $conn->query($sql);

    // print_r($rs);

    // if($conn->query($sql)){
    //     $_SESSION['success']="Record successfully inserted";
    //     header("location:login.php");
    // }else{
    //     $_SESSION['error']="No record created!";
        // header("location:display.php");
    // }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Display Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
        }

        .options {
            display: flex;
            gap: 10px;
            padding:12px
        }

        .edit, .delete {
            padding: 8px;
            background-color: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Employee No</th>
                <th>Employee Name</th>
                <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>PinCode</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Data -->

            
            
            <?php 
            foreach($rs as $r) 
            {  ?>
            <tr>
                <td><?php echo $r['emp_no'];  ?></td>
                <td><?php echo $r['emp_name'];  ?></td>
                <td><?php echo $r['address'];  ?></td>
                <td><?php echo $r['s_name'];  ?></td>
                <td><?php echo $r['c_name'];  ?></td>
                <td><?php echo $r['pincode'];  ?></td>
                <td><?php echo $r['mobile'];  ?></td>
                <td><?php echo $r['email'];  ?></td>
                <!-- <td><img src="../image/"<?php echo $r['photo'];  ?>></td> -->
                <td></td>
                <!-- <td><img src="C:\Users\Vishal Kumar\Downloads\cross1.png" alt="Employee Photo"></td> -->
                <!-- <td></td> -->
                <td class="options">
                    <button class="edit" onclick="window.location.href = 'editemp.php?emp_no=<?php echo $r['emp_no'];  ?>'">Edit</button>
                    <button class="delete" onclick="window.location.href = 'deleteemp.php?emp_no=<?php echo $r['emp_no'];  ?>'">Delete</button>
                </td>
                </tr>
                <?php }
                 ?>
            
           
          
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>
