<?php
ini_set('error_reporting', E_ALL);
include "conn.php";

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

    
    $sql ="INSERT INTO register(emp_no, emp_name, address, mobile, email, password,state, city, photo, pincode)
    VALUES ('$emp_no','$emp_name','$address','$mobile','$email','$password','$state','$city','$photo_name','$pincode')";
    if($conn->query($sql)){
        // $_SESSION['success']="Record successfully inserted";

        echo "<script> alert ('Record Successfully Inserted');</script>";

        header("location:login.php");
    }else{
        $_SESSION['error']="No Record Created!";
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
                    // alert("State"+stateid);
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
    <form action="register.php" method="POST">

    <div class="registration-container">
        <div class="registration-header">
            <h2> Registration</h2>
        </div>
        <div class="registration-form">
            <div class="form-group">
                <label for="empno">Employee No:</label>
                <input type="text" id="empno" name="empno" required>
            </div>
            <div class="form-group">
                <label for="enname">Employee Name:</label>
                <input type="text" id="enname" name="empname" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="tel" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="state"> Select State:</label>
                <select id="state" class="form-control" name="state" required>
                    <option value="">Select State</option>
                    <!-- <option value="state1">State 1</option>
                    <option value="state2">State 2</option>
                    <option value="state3">State 3</option> -->
                    

                   <?php
                   $sql = "SELECT * FROM state";
                   $state=$conn->query($sql);
               
                //    print_r($state);


                   foreach($state as $s)
                   {?>
                    
                   <option value="<?php echo $s['s_id']?>"><?php echo $s['s_name'];?></option>
                  <?php  }
                   ?>

                </select>
            </div>
            <div class="form-group">
                <label for="city">Select City:</label>
                <select id="city" class="form-control" name="city" required>
                    <option value="">Select City</option>
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
                <input id="pin" name="pin" required></input>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Register</button>
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





