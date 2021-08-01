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
  <li style="display:inline"><a href="login.php">Logged in as <?php echo $_SESSION['name']?></a></li>
  <li style="display:inline"><a href="logout.php"> |Logout</a></li>
  <hr style="border:0.1px solid;color:#cccccc;">
  
</ul>
<div style="display:flex; margin-top:100px;">
<fieldset style="width: 330px;">
<form action="upload.php" method="POST" enctype="multipart/form-data">
<legend><b>PROFILE PICTURE</b></legend>
<input type="file" name="file" >
  <span class="error">* </span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  <button type="submit" name="submit">UPLOAD</button>
  
  </form>
</fieldset>
<ul style="list-style-type: none;margin:0;padding:0;float:right; margin-left:280px">
<h3>Account</h3>
  <hr style="border:0.1px solid;color:#cccccc;">
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="viewprofile.php">View Profile</a></li>
  <li style="display:inline"><a href="editprofile.php">Edit Profile</a></li>
  <li><a href="uploadPicture.php">Upload Picture</a></li>
  <li><a href="changepassword.php">Change Password</a></li>
  <li style="display:inline"><a href="logout.php">Logout</a></li>
  <!-- <hr style="border:0.1px solid;color:#cccccc;"> -->
</ul>
</div>

<!-- <div style="border-left: 6px solid black;
  height: 100px;
   position: absolute;  
  left: 57%;
  margin-left: 10px;
  margin-top:30px;
  top: 0; display:inline;">
</div> -->
<!-- <h1><b>Welcome to my Inventory Management</b></h1> -->
<?php
if(!empty($_SESSION["remeber"])){
	setcookie ("name",$_SESSION["name"],time()+ 10);
	setcookie ("pass",$_SESSION["pass"],time()+ 10);
	//echo "Cookies Set Successfuly <br>";
	//echo "Welcome ". $_SESSION["name"];
} else {
	setcookie("name","");
	setcookie("pass","");
	//echo "Cookies Not Set. I will forget you !!!!";
}


//if (isset($_SESSION['name'])) {
//	echo "<h1> Welcome ".$_SESSION['name']."</h1>";
	// echo "<a href='product.php'>Product</a><br>";
	// echo "<br><a href='logout.php'>Logout</a><br>";

//}

?>
<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
</fieldset>

</body>
</html>
