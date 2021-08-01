<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Document</title>
    <style>
.error {color: #FF0000;}
</style>
<script src="logvalidate"></script>
</head>
<body>
<?php
session_start();
$name=$pass=$msg='';
$nameErr=$passErr=''; 
$flag='';
$ermsg='';

if(isset($_POST["submit"])){
  if(!empty($_POST["remember"]))
  {
     $rem=$_POST["remember"];
     $_SESSION["remeber"]=$rem;
  }
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //$kl="xhostdfgsdgsdgsdgfsdgsdg0";
  //echo "xhost";
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (preg_match("/^[0-9]/",$name)) {
      $nameErr = "Must start with a letter";
    }
    else if(!preg_match("/^[a-zA-Z-._ ?!]{2,}$/",$name))
    {
      $nameErr ="At least two words and only contain letters,dash";
    }
  }
  //if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["pass"])) {
      $passErr = "Password is required";
    } else {
      $pass = test_input($_POST["pass"]);
      
      // check if name only contains letters and whitespace
     if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$pass))
      {
        $passErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
        %)";
      }
    //}
 
              //header("location:welcome.php");
              
 
//}

include 'dbconnection.php';
$conn=db_conn();
//$username=$_SESSION['name'];
$sql1 = "SELECT * FROM reg_table where username='$name' and password='$pass'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
  $name1=$row["username"];
  $_SESSION['name'] = $name1;
  $pass1= $row["password"];
  $_SESSION['pass']=$pass1;
}
$sql2="INSERT INTO store_info_table(username, password) 
    values('$name1','$pass1')";
    //$append="hdgdsjgfsj";
    if($conn->query($sql2)===true)
    {
      $message="appended success";
      $flag=true;
      header("location:dashboard.php");
    }else{
      $msgErr="JSON File not exits";
    }
}else{
  $flag=false;
}


/*$data = file_get_contents("data.json"); 
//$data1 = file_get_contents("data1.json");  

$data2 = json_decode($data, true); 
//$data3 = json_decode($data1, true);  
//echo "maeruf";
foreach($data2 as $row)  
{  
	 
	  $name1=$row["username"];
    $_SESSION['name'] = $name1;
	  $pass1= $row["password"];
    $_SESSION['pass']=$pass1;
   
	  // foreach($data3 as $row)
	  // {
		//   $name1=$row["name"];
    //   //$_SESSION['name1'] = $name1;
    //   $email=$row["email"];
    //   //$_SESSION['email']=$email;
    //   $username=$row["username"];
		//   $pass1=$row["password"];
    //   $gender=$row["gender"];
    //   //$_SESSION["gender"]=$gender;
    //   $dob=$row["dobdd"];
    //   //$_SESSION["dob"]=$dob;
    //   $mm=$row["dobmm"];
    //  // $_SESSION["mm"]=$mm;
    //   $yyyy=$row["dobyyyy"];
    //   //$_SESSION["yyyy"]=$yyyy;
     
		  if($name1==$name && $pass1==$pass)
		  {
         
  if(file_exists('data1.json'))
  {
    $current_data=file_get_contents('data1.json');
    $array_data=json_decode($current_data,true);
    $extra=array(
      'username'              =>$_POST["name"],
      'password'       =>$_POST["pass"],
      
      
    );
    //echo $rname;
    
    $array_data[]=$extra;
    $final_data=json_encode($array_data);
    if(file_put_contents('data1.json',$final_data))
    {
      $message="appended success";
      $flag=true;
    }

    else
    {
      $msgErr="JSON File not exits";
    }
  }
			header("location:dashboard.php");
			
			
		  }
       else{
          $flag=false;
          //echo $ermsg;
        
         //header("location:login.php");
          
       }
	  

	 
}*/
}
if($flag==false)
{
  $ermsg="Invalid username & password";
}
}


  


  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }?>
  <!--?php  

session_start();

$username="admin";
$password="admin";

if (isset($_POST['uname'])) {
	if ($_POST['name']==$username && $_POST['pass']==$password) {
		$_SESSION['name'] = $username;
		header("location:welcome.php");
	}
	else{
		$msg="username or password invalid";
		// echo "<script>alert('uname or pass incorrect!')</script>";
	}

}

 ?--> 
 <?php
  
// $data = file_get_contents("data.json"); 
// $data1 = file_get_contents("data1.json");  

// $data = json_decode($data, true); 
// $data1 = json_decode($data1, true);  

// foreach($data1 as $row1)  
// {  
	 
// 	  $name=$row1["username"];
// 	  $pass= $row1["password"];
// 	  foreach($data as $row)
// 	  {
// 		  $name1=$row["username"];
// 		  $pass1=$row["password"];
// 		  if($name==$name1 && $pass==$pass1)
// 		  {
// 			header("location:welcome.php");
			
			
// 		  }
//       else{
//         header("location:login.php");
//       }
// 	  }

	 
// }  




?>
  
  <fieldset style="width: 800px;margin-left:25%">
<legend>Inventory Management</legend>
<ul style="list-style-type: none;margin:0;padding:0;float:right;width:100%;text-align:right;">
  <li style="display:inline"><a href="home.php">Home</a></li>
  <li style="display:inline"><a href="login.php">Login</a></li>
  <li style="display:inline"><a href="registration.php">REGISTRATION</a></li>
  <hr style="border:0.1px solid;color:#cccccc;">
</ul>

<form method="post" style="padding-top: 10px">
<fieldset style="width: 330px;">
<legend><b>LOGIN</b></legend>
User Name: <input type="text" name="name" value="<?php if(isset($_COOKIE["name"])) {echo $_COOKIE["name"];}?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <!-- <br> -->
  &nbsp;Password:&nbsp;&nbsp;&nbsp;<input type="password" name="pass" value="<?php if(isset($_COOKIE["pass"])) {echo $_COOKIE["pass"];}?>">
  <span class="error">* <?php echo $passErr;?></span> <br>
  <input type="checkbox" name="remember" id="remember" value="save1">
  <label for="">Remind Me</label>
  <span class="error"><?php echo $ermsg;?></span>
  
  

  <hr style="border: 1px solid;color:#cccccc;">
  <input type="submit" name="submit" value="Submit" style="width: 100px"> 
  <ul style="list-style-type: none;margin:0;padding:0;float:right;">
  <li style="display:inline"><a href="forgot.php">Forgot Password?</a></li>
  </ul>
</fieldset>  
<br>
</form>

</form>
<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
</fieldset>




</body>
</html>