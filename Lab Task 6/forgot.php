<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Document</title>
    <style>
.error {color: #FF0000;}
.errror{color:green;}
</style>
</head>
<body>
<?php
$email='';
$emailErr=''; 
$emailErrr=''; 

if(isset($_POST["submit"])){
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format. Format: example@anything.com";
          
        }
        session_start();
$data = file_get_contents("data.json");  

$data1 = json_decode($data, true);  

foreach ($data1 as $row ) {
  $email1=$row["email"];
  if ($email1 == $email) {
      
      $emailErrr= "Email exists in data.json";
  }
  else{
    $emailErrr= "Email is not exist in data.json";
  }
}

 
}}



  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }?>
  <fieldset style="width: 800px;margin-left:25%">
<legend>Inventory Management</legend>
<ul style="list-style-type: none;margin:0;padding:0;float:right;width:100%;text-align:right;">
  <li style="display:inline"><a href="home.php">Home</a></li>
  <li style="display:inline"><a href="login.php">Login</a></li>
  <li style="display:inline"><a href="registration.php">REGISTRATION</a></li>
  <hr style="border:0.1px solid;color:#cccccc;">
</ul>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="padding-top: 10px">
<fieldset style="width: 330px;">
<legend><b>FORGOT PASSWORD</b></legend>
Enter Email:<input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  <span class="errror"><?php echo $emailErrr;?></span>
  <input type="submit" name="submit" value="submit" style="width: 100px">
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