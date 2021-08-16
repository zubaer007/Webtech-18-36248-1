<?php
    include 'auth/connection.php';
    $conn= connect();
    $m='';
    $nameErr=$uNameErr=$emailErr=$passErr=$rPassErr=$genderErr=$dobErr='';

    //$email=$uname=$cuPass=$rnewPass=$newPass=$rcpass=$rpass= $dd = $mm = $yyyy = $gender=$proName=$rname=$mismatchpass=$append=$message='';
    //$emailErr=$cuPassErr=$rnewPassErr=$newPassErr=$rcpassErr=$rpass=$unameErr=$dobErr=$mmErr=$yyyyErr=$genderErr=$proNameErr=$misPassErr=$rnameErr=$rpassErr=$msgErr='';
    if(isset($_POST['submit'])){
        $name= $_POST['name'];
        $uName= $_POST['uname'];
        $email= $_POST['email']?$_POST['email']:'';
        $pass= $_POST['pass'];
        $rPass= $_POST['r_pass'];
        $gender=$_POST['gender'];
        $dob=$_POST['birthday'];
        if (empty($name)) {
            $nameErr = "Name is required";
          }else {            
            // check if name only contains letters and whitespace
            if (preg_match("/^[0-9]/",$name)) {
              $nameErr = "Must start with a letter";
            }
            else if(!preg_match("/^[a-zA-Z-. ?!]{2,}$/",$name))
            {
              $nameErr ="At least two words and only contain letters,dash";
            }
          }


        if (empty($uName)) {
            $uNameErr = "Username is required";
          }else{              
              if(preg_match("/^[0-9]/",$uName))
              {
                $uNameErr="Must start with a letter";
                
              }
              else if(!preg_match("/^[a-zA-Z-. ?!]{2,}/",$uName))
              {
                $uNameErr="At least two words and only contain letters,dash";
        
              }
            }


        if (empty($email)) {
            $emailErr = "E-mail is required";
          }else {            
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format. Format: example@anything.com";
              
            }
        }


        if (empty($pass)) {
            $passErr = "Password is required";
          }else{            
            if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$pass))
            {
              $passErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
              %)";
            }
          }


        if (empty($rPass)) {
            $rPassErr = "Confirm password is required";
          }else{            
            if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$rPass))
            {
              $rPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
              %)";
            }
          }


        if (empty($gender)) {
            $genderErr = "Gender is required";
          }
        if (empty($dob)) {
            $dobErr = "Date of birth is required";
          } 




        if($pass===$rPass){
            if($nameErr==''&& $emailErr==''&& $uNameErr==''&& $dobErr=='')
            {
            $sq= "INSERT INTO users_info(name, u_name, email, password, gender,dob) VALUES('$name', '$uName', '$email', '$pass','$gender','$dob')";
            if($conn->query($sq)===true){
                header('Location: login.php');
            }
            else{
                $m='Connection not established!';
            }
        }
    }
        else {
            $m= "Passwords don't match!";
        }
    }



    

?>

<html>
    <head>
        <title>Registration Form </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/register.css">
        <script>
            function enableButton()
            {
                if(document.getElementById("name").value!='' && document.getElementById("uname").value!='' && document.getElementById("email").value!='' && document.getElementById("pass").value!='' && document.getElementById("rpass").value!='')
                {
                    document.getElementById('submit').disabled = false; 
                }
                else
                document.getElementById('submit').disabled = true; 
            }
            function checkUname(val){
    var checkName1= /^[0-9]/;
    var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(checkName1.test(val)){
        document.getElementById('checktext').innerHTML='Must start with a letter!';
        document.getElementById('checktext').style.color='red';
    }
    else if(!checkName2.test(val))
    {
        document.getElementById('checktext').innerHTML='At least two words and only contain letters,dash!';
        document.getElementById('checktext').style.color='red';
    } else{
        document.getElementById('checktext').innerHTML='';
    }
}
            function checkName(val){
    var checkName1= /^[0-9]/;
    var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(checkName1.test(val)){
        document.getElementById('checktext1').innerHTML='Must start with a letter!';
        document.getElementById('checktext1').style.color='red';
    }
    else if(!checkName2.test(val))
    {
        document.getElementById('checktext1').innerHTML='At least two words and only contain letters,dash!';
        document.getElementById('checktext1').style.color='red';
    } else{
        document.getElementById('checktext1').innerHTML='';
    }
}

function checkEmail(val){
    var checkEmail1= /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkEmail1.test(val)){
        document.getElementById('checktext2').innerHTML='Invalid email format. Format: example@anything.com!';
        document.getElementById('checktext2').style.color='red';
    }
    else{
        document.getElementById('checktext2').innerHTML='';
    }
}


function checkPass(val){
    var checkPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkPass1.test(val)){
        document.getElementById('checktext3').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext3').style.color='red';
    }
    else{
        document.getElementById('checktext3').innerHTML='';
    }
}


function checkrPass(val){
    var checkrPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkrPass1.test(val)){
        document.getElementById('checktext4').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext4').style.color='red';
    }
    else if(document.getElementById("pass").value!=document.getElementById("rpass").value)
    {
        document.getElementById('checktext4').innerHTML="Passwords don't match!";
        document.getElementById('checktext4').style.color='red';
    }
    else{
        document.getElementById('checktext4').innerHTML='';
    }
    
}
        </script>
    </head>
    <body>
        <form method="POST" action="register.php">
            <div class="container reg">

                <span><?php if($m!='') echo $m; ?></span>
                <h1> Registration form</h1>
                <hr>
                <div>
                    <label>Your Name<span>*</span></label>
                    <input name="name" id="name" type="text" onkeyup="enableButton()" placeholder="Enter Your Name" onchange="checkName(this.value);">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <small id="checktext1"></small>
                </div>
                <div>
                    <label>Your Username<span>*</span></label>
                    <input name="uname" id="uname" type="text" onkeyup="enableButton()" placeholder="Enter Your Userame" onchange="checkUname(this.value); checkUser(this.value);">
                    <span class="error">* <?php echo $uNameErr;?></span>
                    <small id="checktext"></small>
                    <small id="checkuser"></small>
                </div>
                <div>
                    <label>Your Email<span>*</span></label>
                    <input name="email" id="email" type="text" onkeyup="enableButton()" placeholder="Enter Your Email" onchange="checkEmail(this.value);">
                    <span class="error">* <?php echo $emailErr;?></span>
                    <small id="checktext2"></small>
                </div>
                <div>
                    <label>Password<span>*</span></label>
                    <input name="pass" id="pass" type="password" onkeyup="enableButton()" placeholder="Enter Your Password" onchange="checkPass(this.value);">
                    <span class="error">* <?php echo $passErr;?></span>
                    <small id="checktext3"></small>
                </div>
                <div>
                    <label>Repeat Password<span>*</span></label>
                    <input name="r_pass" id="rpass" type="password" onkeyup="enableButton()" placeholder="Confirm your password" onchange="checkrPass(this.value);">
                    <span class="error">* <?php echo $rPassErr;?></span>
                    <small id="checktext4"></small>
                </div>
                <div>
                <label>Gender </label> 
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
   <span class="error">* <?php echo $genderErr;?></span> 
  <br><br>
  <!-- <span class="error">* <?php echo $genderErr; ?></span> -->
                </div>
                <div>
                <label>Date of birth</label>
  <input type="date" id="birthday" name="birthday">
  <span class="error">* <?php echo $dobErr;?></span>
                </div>
                <div style="text-align: center">
                    <p><span>***</span>By creating an account you agree to our Terms & Conditions.</p>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <input type="submit" class="btn btn-success" value="Submit" id="submit" name="submit" disabled>
                </div>

                <div style="text-align: center">
                    <p>Already have an account? <a href="login.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
</html>


<script>
    $(document).ready(function(){
        $('.reg').css('color', '#ffce00');
        //document.getElementsByClassName('reg')[0].style.color='#ffce00';
    });
    /*window.onload= function(){
          document.getElementsByClassName('reg')[0].style.color='#ffce00';
    };
    *?
     */
</script>
