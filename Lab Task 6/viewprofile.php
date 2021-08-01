<!DOCTYPE html>
<html>
<body>
<?php
session_start();

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
  <li><a href="editprofile.php">Edit Profile</a></li>
  <li><a href="uploadPicture.php">Upload Picture</a></li>
  <li><a href="changepassword.php">Change Password</a></li>
  <li><a href="logout.php">Logout</a></li>
  
</ul>
<!-- <div style="border-left: 6px solid black;
  height: 100px;
  /* position: absolute;  */
  left: 57%;
  margin-left: 600px;
  margin-top:30px;
  top: 0; display:inline;">
</div> -->
<!-- <h1><b>Welcome to my Inventory Management</b></h1> -->
<fieldset style="width: 300px">
<legend>PROFILE</legend>
<div style="display:inline;">
<?php


if (isset($_SESSION['name'])) {
  include 'dbconnection.php';
                $conn=db_conn();
                $username=$_SESSION['name'];
                $sql1 = "SELECT * FROM reg_table where username='$username'";
              $result = $conn->query($sql1);
              
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $name1=$row["name"];
      $email=$row["email"];
      //$_SESSION['email']=$email;
      $username=$row["username"];
	  $pass1=$row["password"];
      $gender=$row["gender"];
      $dob=$row["dobdd"];
      $mm=$row["dobmm"];
      $yyyy=$row["dobyyyy"];

      if($username==$_SESSION['name'])
      {
        echo " Name            : " .$_SESSION['name']."<br>";
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
        echo " Email           : " .$email."<br>";
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
       
        
        echo " Gender          : " .$gender."<br>";
        
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
    
        echo " Date of Birth   : " ,$dob;
        echo " " ,$mm;
        echo " " .$yyyy."<br>";
        echo "<a href='editprofile.php'>Edit Profile</a>";
      }

                }}}
    /*$data = file_get_contents("data.json");
    $data2 = json_decode($data, true); 
    foreach($data2 as $row)
	  {
          //echo "helllllooooooooooooo";
	  $name1=$row["name"];
      $email=$row["email"];
      //$_SESSION['email']=$email;
      $username=$row["username"];
	  $pass1=$row["password"];
      $gender=$row["gender"];
      $dob=$row["dobdd"];
      $mm=$row["dobmm"];
      $yyyy=$row["dobyyyy"];

      if($username==$_SESSION['name'])
      {
        echo " Name            : " .$_SESSION['name']."<br>";
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
        echo " Email           : " .$email."<br>";
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
       
        
        echo " Gender          : " .$gender."<br>";
        
        echo "<hr style='border:0.1px solid;color:#cccccc'>" ;
    
        echo " Date of Birth   : " ,$dob;
        echo " " ,$mm;
        echo " " .$yyyy."<br>";
        echo "<a href='editprofile.php'>Edit Profile</a>";
      }
    }*/

	
    //}
    
    
	// echo "<a href='product.php'>Product</a><br>";
	// echo "<br><a href='logout.php'>Logout</a><br>";

//}
?>

</div>


</fieldset>

<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
</fieldset>

</body>
</html>
