<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
session_start();
?>
   <?php 
   $newPass=$rnewPass=$cuPass=$message1= $passErr=$message='';
   $newPassErr=$rnewPassErr=$cuPassErr='';
   if(isset($_POST["submit1"])){
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["cuPass"])) {
        $passErr = "Password is required";
      } else {
        $cuPass = test_input($_POST["cuPass"]);
        // check if name only contains letters and whitespace
       if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$cuPass))
        {
          $cuPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
          %)";
        }
      }
    
    
    
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["newPass"])) {
        $newPassErr = "Password is required";
      } else {
        $newPass = test_input($_POST["newPass"]);
        //echo $newPass;
        //echo $cuPass;
        // check if name only contains letters and whitespace
       if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$newPass))
        {
          $newPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
          %)";
        }
        if($newPass==$cuPass)
                {
                  $newPassErr="New Password should not be same as the Current Password";
                }
              }
            
    
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["rnewPass"])) {
            $rnewPassErr = "Password is required";
          } else {
            $rnewPass = test_input($_POST["rnewPass"]);
            // check if name only contains letters and whitespace
           if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$rnewPass))
            {
              $rnewPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
              %)";
            }
            if($rnewPass!=$newPass)
                {
                  $rnewPassErr="New Password must match with the Retyped Password";
                }
          

                if($newPass!=$cuPass && $rnewPass==$newPass)
                {
                  include 'dbconnection.php';
                $conn=db_conn();
                $username=$_SESSION['name'];
                
                $sql1 = "SELECT * FROM reg_table where username='$username'";
              $result = $conn->query($sql1);
              
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $pass1= $row["password"];
                  //echo $pass1;
                  if($cuPass==$pass1){
                    $sql2="UPDATE reg_table set password='$rnewPass' where username='$username' and password='$pass1'";
                 
    //$append="hdgdsjgfsj";
    if($conn->query($sql2)===true)
    {
      $message="appended success";
    }else
    {
      $message="Sorry";
    }
                  }else
                  {
                    $message1="password mismatch";
                  }
                  
                }}
                else
                {
                  $message="password mismatch";
                }
                }
                
            
           /*if(file_exists('data1.json'))
           {
             $current_data=file_get_contents('data1.json');
             $array_data=json_decode($current_data,true);
             $extra=array(
               'username'              =>$_POST["name"],
               'password'       =>$_POST["pass"],
              
              
             );
            echo $rname;
            
            $array_data[]=$extra;
            $final_data=json_encode($array_data);
            if(file_put_contents('data1.json',$final_data))
            {
              $message="appended success";
              
            }

            else
            {
              $msgErr="JSON File not exits";
            }
          }*/

         // session_start();
/*$data = file_get_contents("data.json"); 
//$data1 = file_get_contents("data1.json");  

$data2 = json_decode($data, true); 
foreach ($data2 as $key => $entry) {
  if ($entry['password'] == $cuPass) {
      $data2[$key]['password'] = $rnewPass;
  }
}*/
//$data3 = json_decode($data1, true);  
//echo "maeruf";
/*foreach($data2 as $row)  
{  
	 
	  // $name=$row["username"];
    // $_SESSION['name'] = $name;
	  $pass= $row["password"];
	  
		  //$name1=$row["name"];
      //$email=$row["email"];
      //$username=$row["username"];
		 // $pass=$row["password"];
     // $gender=$row["gender"];
     // $dob=$row["dobdd"];
      //$mm=$row["dobmm"];
      //$yyyy=$row["dobyyyy"];
      
		  if($pass==$cuPass)
		  {
			//header("location:welcome.php");
		/*	if(file_exists('data.json'))
              {
                $current_data=file_get_contents('data.json');
                $array_data=json_decode($current_data,true);
                $extra=array(
                  // 'username'              =>$_POST["name"],
                  'password'       =>$_POST["password"],
                  
                  
                );
                $array_data[]=$extra;
                $final_data=json_encode($array_data);
                if(file_put_contents('data.json',$final_data))
                {
                  $message="appended success";
                  
                }

                else
                {
                  $msgErr="JSON File not exits";
                }
			
		  }
       else{
         header("location:login.php");
       }
	  
*/
/*$row["password"]=$rnewPass;
$json_object = json_encode($row["password"]);
if(file_put_contents('data.json', $json_object))
{
  header("location:login.php");
  $message="appended success";
  
}

else
{
  $msgErr="JSON File not exits";
}
}*/


/*$final_data=json_encode($data2);
if(file_put_contents('data.json',$final_data))
{
  $message="appended success";
  
}

else
{
  $msgErr="JSON File not exits";
}
    */
          
    }
  }
//}
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;}
   
   ?>

<fieldset style="width: 800px;margin-left:25%">
<legend>Inventory Management</legend>
<ul style="list-style-type: none;margin:0;padding:0;float:right;width:100%;text-align:right;">
  <!-- <li style="display:inline"><a href="#home">Home</a></li> -->
  <li style="display:inline"><a href="login.php">Logged in as <?php echo $_SESSION['name'];?></a></li>
  <li><a href="logout.php">Logout</a></li>
  <!-- <li style="display:inline"><a href="registration.php">REGISTRATION</a></li> -->

  <!-- <ul style="list-style-type: none;margin:0;padding:0;float:right;"> -->
  
  
<!-- </ul> -->
  <hr style="border:0.1px solid;color:#cccccc;">
</ul>
<ul style="list-style-type: none;margin:0;padding:0;float:right;">
<h3>Account</h3>
  <hr style="border:0.1px solid;color:#cccccc;">
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="viewprofile.php">View Profile</a></li>
  <li><a href="uploadPicture.php">Upload Picture</a></li>
  <li><a href="changepassword.php">Change Password</a></li>
  <li><a href="logout.php">Logout</a></li>
  
</ul>
<!-- <h1><b>Welcome to my Inventory Management</b></h1> -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="padding-top: 10px">
<fieldset style="width: 360px;">
<legend><b>CHANGE PASSWORD</b></legend>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <p>Current Password:</p> <input type="password" name="cuPass" value="<?php echo $cuPass;?>">
  <span class="error" style="display:inline">* <?php echo $cuPassErr; echo $passErr;?></span>
  <span><?php echo $message1; ?></span>
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <p style="color:green;">New Password:</p> <input type="password" name="newPass" value="<?php echo $newPass;?>">
  <span class="error">* <?php echo $newPassErr;?></span>
 <p style="color:red;">Retype New Password:</p> <input type="password" name="rnewPass"  value="<?php echo $rnewPass;?>">
  <span class="error" style="display:inline;">* <?php echo $rnewPassErr;?></span>
  <hr style="border: 1px solid;color:#cccccc;">
<span><?php echo $message; ?></span>
  <input type="submit" name="submit1" value="submit" style="width: 100px">
  </form>
</fieldset>  
<br>
<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
</fieldset>


</body>
</html>