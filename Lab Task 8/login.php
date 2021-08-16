<?php
session_start();
$_SESSION['user']='';
$_SESSION['userid']='';
include "auth/connection.php";
$conn= connect();
$m='';
$uNameErr=$passErr='';
if(isset($_POST['submit']))
{
    if(!empty($_POST["remember"]))
  {
     $rem=$_POST["remember"];
     $_SESSION["remeber"]=$rem;
  }
   
    $uName=$_POST['uname'];
    $pass=$_POST['pass'];
    $_SESSION['name']=$uName;
    $_SESSION['pass']=$pass;

    if (empty($uName)) {
        $uNameErr = "Name is required";
      }else {            
        // check if name only contains letters and whitespace
        if (preg_match("/^[0-9]/",$uName)) {
          $uNameErr = "Must start with a letter";
        }
        else if(!preg_match("/^[a-zA-Z-. ?!]{2,}$/",$uName))
        {
          $uNameErr ="At least two words and only contain letters,dash";
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



    $sql="SELECT * FROM users_info WHERE u_name='$uName' and password='$pass'";
    $res=$conn->query($sql);
    if(mysqli_num_rows($res)==1)
    {
        $user= mysqli_fetch_assoc($res);
        $_SESSION['user']=$user['name'];
        $_SESSION['userid']=$user['id'];
        header('Location: dashboard.php');
    }
    else
    {
        $m='Credentials Mismatch!';
    }
}
?>
<html>
    <head>
     <link type="text/css" rel="stylesheet" href="css/indexstyle.css">
     <link type="text/css" rel="stylesheet" href="css/login2.css">
    </head>
    <body>
        <div class="logo">

        </div>
        <form method="POST">
            <div class="box bg-img">
                <div class="content">
                    <h2>Log<span>In</span></h2>
                    <div class="forms">
                    <p style="color: red; padding: 20px;"><?php if($m!='') echo $m; ?></p>
                        <div class="user-input">
                            <input name="uname" type="text" class="login-input" placeholder="Username" onchange="checkUserName(this.value);" id="name" value="<?php if(isset($_COOKIE["name"])) {echo $_COOKIE["name"];}?>">
                            <i class="fas fa-user"></i>
                            

                        </div>
                        <span class="error" style="color:red;"> <?php echo $uNameErr;?></span>
                        <small id="checktext1"></small>
                        <div class="pass-input">
                            <input name="pass" type="password" class="login-input" placeholder="Password" onchange="checkPass(this.value);" id="my-password" value="<?php if(isset($_COOKIE["pass"])) {echo $_COOKIE["pass"];}?>">
                            <span class="eye" onclick="myFunction()">
                            <i id="hide-1" class="fas fa-eye-slash"></i>
                            <i id="hide-2" class="fas fa-eye"></i>
                            

                            </span>
                            <span class="error" style="color:red;"> <?php echo $passErr;?></span>
                            <small id="checktext2"></small>

                        </div>

                    </div>
                    <input type="checkbox" name="remember" id="remember" value="save1">
                    <h3 style="display:inline;">Remember Me</h3>
                    <button class="login-btn" name="submit" type="submit">Sign In</button>
                    <p class="new-account">Not a user? <a href="register.php">Sign Up now!</a></p>
                    <br>
                    <p class="f-pass">
                        <a href="#">forgot password?</a>
                    </p>

                </div>

            </div>
        </form>
        <script src="https://kit.fontawesome.com/c0078485ae.js" crossorigin="anonymous"></script>
    </body>
</html>
<script>
    function myFunction(){
        var x= document.getElementById("my-password");
        var y=document.getElementById("hide-1");
        var z=document.getElementById("hide-2");
        if(x.type==="password")
        {
            x.type="text";
            y.style.display="block";
            z.style.display="none";
        }
        else
        {
            x.type="password";
            y.style.display="none";
            z.style.display="block";
        }
    }



    function checkUserName(val){
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


function checkPass(val){
    var checkPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkPass1.test(val)){
        document.getElementById('checktext2').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext2').style.color='red';
    }
    else{
        document.getElementById('checktext2').innerHTML='';
    }
}
</script>