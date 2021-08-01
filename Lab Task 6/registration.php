<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Document</title>
    <style>
    .error {color: #FF0000;}
    </style>
</head>
<body>
<?php
include 'dbconnection.php';
$conn=db_conn();

    $email=$uname=$cuPass=$rnewPass=$newPass=$rcpass=$rpass= $dd = $mm = $yyyy = $gender=$proName=$rname=$mismatchpass=$append=$message='';
    $emailErr=$cuPassErr=$rnewPassErr=$newPassErr=$rcpassErr=$rpass=$unameErr=$dobErr=$mmErr=$yyyyErr=$genderErr=$proNameErr=$misPassErr=$rnameErr=$rpassErr=$msgErr='';
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
            if(empty($_POST["uname"]))
            {
              $unameErr="Name is required";
            }
            else{
              $uname=test_input($_POST["uname"]);
              if(preg_match("/^[0-9]/",$uname))
              {
                $unameErr="Must start with a letter";
                
              }
              else if(!preg_match("/^[a-zA-Z-. ?!]{2,}/",$uname))
              {
                $unameErr="At least two words and only contain letters,dash";
        
              }
            }
        
            if(empty($_POST["rpass"]))
            {
              $rpassErr="Password is required";
            }
            else{
              $rpass=test_input($_POST["rpass"]);
              
              if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$rpass))
              {
                $rpassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
                %)";
              }
            }
        
            if(empty($_POST["rcpass"]))
            {
              $rcpassErr="Password is required";
            }
            else{
              $rcpass=test_input($_POST["rcpass"]);
              
              if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$rcpass))
              {
                $rcpassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
                %)";
              }
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
              if($rpass==$rcpass)
              {
                if($rnameErr==''&&$emailErr==''&&$unameErr==''&&$dobErr=='')
                {
                  $insert="INSERT INTO reg_table(name,email,username,password,gender,dobdd,dobmm,dobyyyy)
                VALUES ('$rname','$email','$uname','$rpass','$gender','$dd','$mm','$yyyy')";
                if($conn->query($insert)===true)
                {
                $append="append successful";
                }
                else
                {
                  $append="Can't append";
                }
                }
                else
                {
                  $append="invalid information";
                }
              
                
              }
              else
              {
                $mismatchpass="password mismatch";
              }
             
              // if(file_exists('data.json'))
              // {
                
              // }
              // {
              //   $current_data=file_get_contents('data.json');
              //   $array_data=json_decode($current_data,true);
              //   $extra=array(
              //     'name'              =>$_POST["rname"],
              //     'email'            =>$_POST["email"],
              //     'username'        =>$_POST["uname"],
              //     'password'       =>$_POST["rpass"],
              //     'gender'        =>$_POST["gender"],
              //     'dobdd'        =>$_POST["dd"],
              //     'dobmm'       =>$_POST["mm"],
              //     'dobyyyy'    =>$_POST["yyyy"]
                  
              //   );
              //   //echo $rname;
                
              //   $array_data[]=$extra;
              //   $final_data=json_encode($array_data);
              //   if(file_put_contents('data.json',$final_data))
              //   {
              //     $message="appended success";
              //   }
              //   else
              //   {
              //     $msgErr="JSON File not exits";
              //   }
              // }
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
  <li style="display:inline"><a href="home.php">Home</a></li>
  <li style="display:inline"><a href="login.php">Login</a></li>
  <li style="display:inline"><a href="registration.php">REGISTRATION</a></li>
  <hr style="border:0.1px solid;color:#cccccc;">
</ul>
<form method="post" style="padding-top: 10px">
<fieldset style="width: 300px;">
<legend><b>REGISTRATION</b></legend>
Name:<input type="text" name="rname" value="<?php echo $rname;?>">
  <span class="error">* <?php echo $rnameErr;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  Email:<input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  User Name:<input type="text" name="uname" value="<?php echo $uname;?>">
  <span class="error">* <?php echo $unameErr;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  Password:<input type="password" name="rpass" value="<?php echo $rpass;?>">
  <span class="error">* <?php echo $rpassErr;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  Confirm Password:<input type="password" name="rcpass" value="<?php echo $rcpass;?>">
  <span class="error">* <?php echo $rcpassErr; echo $mismatchpass;?></span>
  <br>
  <hr style="border: 1px solid;color:#cccccc;">
  <fieldset style="width: 300px;">
  <legend><b>GENDER </b></legend>
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <span class="error">* <?php echo $genderErr; ?></span>
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
  <td><input type="text" name="dd" style="width: 30px" value="<?php echo $dd;?>"></td>
  <td>&nbsp;&nbsp;/</td>
  <td><input type="text" name="mm" style="width: 30px;margin-left:-50%" value="<?php echo $mm;?>">
  &nbsp;&nbsp;/</td>
  <td><input type="text" name="yyyy" style="width: 30px;margin-left:-100%" value="<?php echo $yyyy;?>"></td>
  <td style="padding-left: 10px"><span class="error">*<?php echo $dobErr;?></span></td>
  </tr>
  </table>
  <hr style="border: 1px solid;color:#cccccc;">
  <!-- <input type="submit" name="submit4" value="submit" style="width:100px"> -->
  </fieldset>
  <br>
  <span ><?php echo $append;?></span>
  <input type="submit" name="submit5" value="submit" style="width: 100px">
  <input type="submit" name="reset" value="reset"style="width: 100px">
</fieldset>  

<br>
</form>
<footer style="text-align:center;width:100%;bottom:0;left:0;margin-top:140px;">
<hr style="border:0.1px solid;color:#cccccc;">
  <a href="mailto:marufhossain220195@gmail.com">Copyright&#169;2021 Mail to developer</a></p>
</footer>
    
</body>
</html>