<?php
    include "conn.php";
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);

    $emp_no = $_GET['emp_no'];
    
    $sql ="SELECT * FROM register WHERE emp_no ='$emp_no'";
    $result = $conn->query($sql);
    $result2 = $result-> fetch_array(MYSQLI_ASSOC);
    //print_r();

    $sql1 = "SELECT c_name,s_name,r.state,r.city from city c, state s, register r where r.state=s.s_id and r.city=c.c_id and r.emp_no='$emp_no'"; 
    $rs = $conn->query($sql1);
    $result3= $rs-> fetch_array(MYSQLI_ASSOC);
 
    //   echo "state :".$result3['s_name'];

    $sql2 = "SELECT * from state where s_id=(select state from register where emp_no='$emp_no') ";
    $rs1 = $conn->query($sql2);
    $result4 = $rs1-> fetch_array(MYSQLI_ASSOC);
    
    // echo "state :".$result4['s_id'];

    $sql3 = "SELECT * FROM state ";
    $rs2 = mysqli_query($conn,$sql3);
    $result5 = mysqli_fetch_array($rs2);
    // while($result5 = mysqli_fetch_array($rs2)){
    //     echo "line 29";
    //     print_r($result5);
    // }
     
    //   echo "state :".$result3['s_id'];

    $sql4 = "SELECT * FROM city where c_id=(select city from register where emp_no='$emp_no')";
    $rs3 = $conn->query($sql4);
    $result6 = mysqli_fetch_array($rs3);
    // $result6 = $rs3-> fetch_array(MYSQLI_ASSOC);
    //  while($result6 = mysqli_fetch_array($rs3)){
    //     echo "line 41";
    //     print_r($result6);
    // }
      
    // echo "city :".$result6['c_id'];




    $sql5 = "SELECT * FROM city";
    $rs4 = $conn->query($sql5);
    $result7 = mysqli_fetch_array($rs4);
    // $result6 = $rs3-> fetch_array(MYSQLI_ASSOC);
    //  while($result7 = mysqli_fetch_array($rs4)){
    //     echo "line 51";
    //     print_r($result7);
    // }


    //  echo "city :".$result5['c_name'];
    //  echo "state :".$result4['s_name'];
    
 
    // echo "state:".$result3['state'];
    // echo "city:".$result3['c_name'];

    // foreach($result5 as $a){
    //     echo $a['s_name'];
    // }
   

    // create the dropdown menu for state
    $msg = '';
    $msg1 = '';
    // echo "state:".$result3['state']."==s_id:".$result4['s_id'];
    // print_r($result5);
    // echo "Count:".count($result5);
               
        $resultFinal = mysqli_query($conn, $sql1);
        while($row = mysqli_fetch_array($resultFinal))
        {
            // echo "LiNE 58";
            // print_r($row);
            if($result3['state']==$result4['s_id'] && $result3['city']==$result6['c_id'])
            {
                // echo "Line52:".$row['state'];
                $msg .= '<option value = "'.$row['state'].'" selected="selected">'.$row['s_name'].'</option>  ';
                $msg1 .= '<option value = "'.$row['city'].'" selected="selected">'.$row['c_name'].'</option>  ';
                
            }
            // else
            // {   
                $rs2 = mysqli_query($conn,$sql3);
                while($result5 = mysqli_fetch_array($rs2)){
                    if($result5['s_id']!=$result4['s_id']){
                        $msg .= '<option value = "'.$result5['s_id'].'" >'.$result5['s_name'].'</option>  ';    
                    }  
                }   
                $rs4 = mysqli_query($conn,$sql5);
                while($result7 = mysqli_fetch_array($rs4)){
                    if($result7['c_id']!=$result6['c_id']){
                        $msg1 .= '<option value = "'.$result7['c_id'].'" >'.$result7['c_name'].'</option>  ';    
                    }
                }
                
                
            // }        
        }




    // echo "<select>";
    //     echo <option value = '".$result3['s_name']."'>.$result3['s_name']</option>;
    // echo "</select>";
    

    // echo "emp_name:".$result2['emp_name'];
    $emp_no = isset($result2['emp_no'])?$result2['emp_no']:"";
    $emp_name = isset($result2['emp_name'])?$result2['emp_name']:"";
    $address = isset($result2['address'])?$result2['address']:"";
    $mobile = isset($result2['mobile'])?$result2['mobile']:"";
    $email = isset($result2['email'])?$result2['email']:"";
    $password = isset($result2['password'])?$result2['password']:"";
    $state = isset($result3['s_name'])?$result3['s_name']:"";
    $city = isset($result3['c_name'])?$result3['c_name']:"";
    $pincode = isset($result2['pincode'])?$result2['pincode']:"";
    $photo = isset($result2['photo'])?$result2['photo']:"";
    
    if(isset($_POST['submit']))
{
    $emp_no =$_POST['empno'];
    $emp_name=$_POST['empname'];
    $address=$_POST['address'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $pincode=$_POST['pin'];

   if(isset($_FILES['photo']))
   {
   $photo_name=$_FILES['photo']['name'];
   $source_path=$_FILES['photo']['tmp_name'];
   print_r( $source_path);

   if($photo_name !="")
   {
     $explodeName = explode('.',$photo_name);
     $ext = end($explodeName);

     $photo_name="profile_name".rand(0000,9999).'.'.$ext;
     $destionationpath='../image/'.$photo_name;

     $upload= move_uploaded_file($source_path,$destionationpath);

    //  if($upload==false)
    //  {
    //     echo  '<div class="alert-danger">Failed to upload image</div>';
    //     die();
    //  }
   }
   
}

    
    $sql ="UPDATE register SET emp_no='$emp_no',emp_name='$emp_name',address='$address',mobile='$mobile',email='$email',password='$password',state='$state',city='$city',photo='$photo',pincode='$pincode' WHERE emp_no='$emp_no'";
    if($conn->query($sql)){
        // $_SESSION['success']="Record successfully inserted";

        echo "<script> alert ('Record Updated Successfully!');</script>";

        header("location:login.php");
    }else{
        $_SESSION['error']="No record Updated!";
        // header("location:display.php");
    }

}
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">  
    </script>  
    <script type="text/javascript" language="javascript">  
    // $(document).ready(function() { 
    //     alert("Working");  
    // });  

    $(document).ready(function(){
                
                $("#state").on('change',function()
                {
                    var stateid = $(this).val();
                    alert("State"+stateid);
                    $.ajax({
                        method:"POST",
                        url:"getcity.php",
                        data:{id:stateid},
                        dataType:"html",
                        success:function(data){
                            $("#city").html(data);
                        }
                    }); 
                });
                });
    </script>  
    <style>
        body {
            font-family: 'Segoe UI, Tahoma, Geneva, Verdana, sans-serif';
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            text-align: center;
        }

        .registration-header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
        }

        .registration-header h2 {
            margin: 0;
        }

        .registration-form {
            padding: 20px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .form-group label {
            width: 120px;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
            text-align: right;
            padding-right: 20px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            flex: 1;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            margin-top: 6px;
        }

        .form-group select {
            width: calc(100% + 2px);
            margin-left: -1px;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-group button {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .form-group button.reset-button {
            background-color: #e74c3c;
            margin-left: 10px;
            /* align: left; */
        }

        .form-group button:hover,
        .form-group button.reset-button:hover {
            background-color: #27ae60;
        }
    </style>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <script>
            $(document).ready(function(){
                alert("State");
                console.log("State");
                $("#state").on('change',function()
                {
                    var stateid = $(this).val();
                    alert("State"+stateid);
                    $.ajax({
                        method:"POST",
                        url:"getcity.php",
                        data:{id:stateid},
                        dataType:"html",
                        success:function(data){
                            $("#state").html(data);
                        }
                    }); 
                });
                });


    </script> -->
</head>
<body>
    <form action="editemp.php" method="POST">

    <div class="registration-container">
        <div class="registration-header">
            <h2> Registration</h2>
        </div>
        <div class="registration-form">
            <div class="form-group">
                <label for="empno">Employee No:</label>
                <input type="text" id="empno" name="empno" value="<?php echo $emp_no;?>" required >
            </div>
            <div class="form-group">
                <label for="enname">Employee Name:</label>
                <input type="text" id="enname" name="empname" value="<?php echo $emp_name;?>"  required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $address;?>"  required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo $mobile;?>"  required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"  value="<?php echo $email;?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $password;?>"  required>
            </div>
            <div class="form-group">
                <label for="state"> Select State:</label>
                <select id="state" class="form-control" name="state" ><?php echo $msg; ?></select>
            </div>
<!-- displaySelectedValue -->

<!-- <script>
function displaySelectedValue() {
  var dropdown = document.getElementById("state");
  var selectedValue = dropdown.options[dropdown.selectedIndex].value;
  alert("You selected " + selectedValue);
} -->
</script>



            <div class="form-group">
                <label for="city">Select City:</label>
                <select id="city" class="form-control" name="city"><?php echo $msg1; ?>
                    <!-- <option value="">Select City</option> -->
                    <!-- <option value="city1">City 1</option>
                    <option value="city2">City 2</option>
                    <option value="city3">City 3</option> -->

                    <!-- <script>
                      $('#state').change(function(){
                 
                 var s_id = $(this).val();

                 //alert(s_id);

                 $.ajax({
                          method:'POST',
                          url: 'getcity.php',
                          data:{
                                    'getcity': true,
                                   's_id':s_id,
                          },
                          success:function(result){
                            
                            $('#city').html(result);
                          } 

                 });
                 
            });
            </script> -->


                </select>
            </div>
            <div class="form-group">
                <label for="pin">Pin Code:</label>
                <input id="pin" name="pin" value="<?php echo $pincode;?>" required></input>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" value="<?php echo $photo;?>"  required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Update</button>
                <button type="reset" class="reset-button" value="reset">Reset</button>
            </div>
        </div>
    </div>
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
      

</body>
</html>