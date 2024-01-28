<?php
include "conn.php";
// include "../libs/app.php";

if(isset($_POST['id']))
{
    $id = $_POST['id'];

$sql = "SELECT * from city  where s_id = '$id' "; 

$city=$conn->query($sql);
// {
//   $id=$row['id'];
//   $city=$row['city'];
//   echo "<option value='$id'>$city</option>";

// }

foreach($city as $c)
                   {
                    
                  echo '<option value='. $c['c_id'].'> '.$c['c_name'].'</option>';
                   }
                   

}

?>
