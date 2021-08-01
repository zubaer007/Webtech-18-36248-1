<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .error {color: #FF0000;}
    </style>  
</head>
<body>
<?php

session_start();
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
      $email1=$row["email"];
      //$_SESSION['email']=$email;
      $username1=$row["username"];
	    $pass1=$row["password"];
      $gender1=$row["gender"];
      $dob1=$row["dobdd"];
      $mm1=$row["dobmm"];
      $yyyy1=$row["dobyyyy"];
                }}}
    /*$data = file_get_contents("data.json");
    $data2 = json_decode($data, true); 
    foreach($data2 as $row)
	  {
      //echo "helllllooooooooooooo";
	    $name1=$row["name"];
      $email1=$row["email"];
      //$_SESSION['email']=$email;
      $username1=$row["username"];
	    $pass1=$row["password"];
      $gender1=$row["gender"];
      $dob1=$row["dobdd"];
      $mm1=$row["dobmm"];
      $yyyy1=$row["dobyyyy"];

      
    }*/

	
    //}
?>
<?php
    $email=$uname=$cuPass=$rnewPass=$newPass=$rcpass=$rpass= $dd = $mm = $yyyy = $gender=$proName=$rname=$message='';
    $emailErr=$cuPassErr=$rnewPassErr=$newPassErr=$rcpassErr=$rpass=$unameErr=$dobErr=$mmErr=$yyyyErr=$genderErr=$proNameErr=$misPassErr=$rnameErr=$rpassErr=$msgErr=$nameErr='';
    if(isset($_POST["submit5"])){
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          if (empty($_POST["rname"])) {
            $rnameErr = "Name is required";
          } else {
            $rname = test_input($_POST["rname"]);
            // check if name only contains letters and whitespace
            if (preg_match("/^[0-9]/",$rname)) {
              $rnameErr = "Must start with a letter";
            }
            else if(!preg_match("/^[a-zA-Z-. ?!]{2,}$/",$rname))
            {
              $rnameErr ="At least two words and only contain letters,dash";
            }
          }
          
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format. Format: example@anything.com";
              
            }
            
        
            
        
            if(empty($_POST["dd"]) or empty($_POST["mm"]) or empty($_POST["yyyy"])){
              $dobErr="Full Date of birth input is requied";
              $dd = test_input($_POST["dd"]);
              $mm = test_input($_POST["mm"]);
              $yyyy = test_input($_POST["yyyy"]);
          
            }
            else
            {
              $dd = test_input($_POST["dd"]);
              $mm = test_input($_POST["mm"]);
              $yyyy = test_input($_POST["yyyy"]);
          
              if( !filter_var($dd,FILTER_VALIDATE_INT,array('options' => array(
                      'min_range' => 1, 
                      'max_range' => 31
                  )))|!filter_var($mm,FILTER_VALIDATE_INT,array('options' => array(
                      'min_range' => 1, 
                      'max_range' => 12
                  )))|!filter_var($yyyy,FILTER_VALIDATE_INT,array('options' => array(
                      'min_range' => 1953, 
                      'max_range' => 1998
                  ))))
                {$dobErr="Must be valid numbers(dd:1-31,mm: 1-12,yyyy: 1953-1998)";}
            }
          }
            
         
        
          if(!isset($_POST["gender"]))
            {
                $genderErr="At least one of them must be selected";
            }
        
            else{
              $gender = test_input($_POST["gender"]);

              $sql2="UPDATE reg_table set name='$rname',email='$email', gender='$gender', dobdd='$dd',dobmm='$mm',dobyyyy='$yyyy' where username='$username'";
    //$append="hdgdsjgfsj";
    if($conn->query($sql2)===true)
    {
      $message="appended success";
    }else{
      $message="Sorry";
    }
              /*if(file_exists('data.json'))
              {
                // $current_data=file_get_contents('data.json');
                // $array_data=json_decode($current_data,true);
                // $extra=array(
                //   'name'              =>$_POST["rname"],
                //   'email'            =>$_POST["email"],
                //   'gender'        =>$_POST["gender"],
                //   'dobdd'        =>$_POST["dd"],
                //   'dobmm'       =>$_POST["mm"],
                //   'dobyyyy'    =>$_POST["yyyy"]
                  
                // );
                // //echo $rname;
                
                // $array_data[]=$extra;
                $data = file_get_contents("data.json"); 
//$data1 = file_get_contents("data1.json");  

$data2 = json_decode($data, true); 
foreach ($data2 as $key => $entry) {
  if ($entry['username'] == $_SESSION['name']) {
      $data2[$key]['name'] = $_POST["rname"];
      $data2[$key]['email'] = $_POST["email"];
      $data2[$key]['gender'] = $_POST["gender"];
      $data2[$key]['dobdd'] = $_POST["dd"];
      $data2[$key]['dobmm'] = $_POST["mm"];
      $data2[$key]['dobyyyy'] = $_POST["yyyy"];
  }
}
                $final_data=json_encode($data2);
                if(file_put_contents('data.json',$final_data))
                {
                  $message="appended success";
                }
                else
                {
                  $msgErr="JSON File not exits";
                }
              }*/
            }
            
        }
       
        
        
        
        
          
          function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;}
    ?>
<fieldset style="width: 800px;margin-left:25%">
<legend>Inventory Management</legend>
<ul style="list-style-type: none;margin:0;padding:0;float:right;width:100%;text-align:right;">
  <li style="display:inline"><a href="login.php">Logged in as <?php echo $_SESSION['name']?></a></li>
  
  <li style="display:inline"><a href="logout.php">Logout</a></li>
  <hr style="border:0.1px solid;color:#cccccc;">
</ul>
<ul style="list-style-type: none;margin:0;padding:0;float:right;">
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
<form method="post" style="padding-top: 10px">
<fieldset style="width: 300px;">
<legend><b>EDIT PROFILE</b></legend>
Name:<input type="text" name="rname" value="<?php echo $name1;?>">
  <span class="error">* <?php echo $rnameErr;?></span> 
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  Email:<input type="text" name="email" value="<?php echo $email1;?>">
  <span class="error">* <?php echo $emailErr;?></span> 
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  
  <hr style="border: 1px solid;color:#cccccc;">
  <fieldset style="width: 300px;">
  <legend><b>GENDER </b></legend>
  <input type="radio" name="gender" <?php if (isset($gender1) && $gender1=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender1) && $gender1=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender1) && $gender1=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
   <!-- <span class="error">* <?php echo $genderErr; ?></span>  -->
  <hr style="border: 0.1px solid;color:#cccccc;">
  <!-- <input type="submit" name="submit3" value="Submit" style="width: 100px">   -->
  </fieldset>
  <br>
  <fieldset style="width: 300px;">
  <legend><b>DATE OF BIRTH</b></legend>
  <table>
  <tr style="text-align: center;">
         <th style="font-weight: normal;"><label for="dd">dd</label></th>
         <th style="font-weight: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="mm">mm</label></th>
         <th style="font-weight: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="yyyy">yyyy</label></th>
         
  </tr>
  <tr>
  <td><input type="text" name="dd" style="width: 30px" value="<?php echo $dob1;?>"></td>
  <td>&nbsp;&nbsp;/</td>
  <td><input type="text" name="mm" style="width: 30px;margin-left:-50%" value="<?php echo $mm1;?>">
  &nbsp;&nbsp;/</td>
  <td><input type="text" name="yyyy" style="width: 30px;margin-left:-100%" value="<?php echo $yyyy1;?>"></td>
  <td style="padding-left: 10px"><span class="error">*<?php echo $dobErr;?></span></td>
  </tr>
  </table>
  <hr style="border: 1px solid;color:#cccccc;">
  
  </fieldset>
  <br>
  <span><?php echo $message; ?></span>
  <input type="submit" name="submit5" value="submit" style="width: 100px">
  <!-- <input type="submit" name="reset" value="reset"style="width: 100px"> -->
</fieldset>  

<br>
</form>
<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
</fieldset>
    
</body>
</html>
