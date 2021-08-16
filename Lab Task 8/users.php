<?php
    session_start();
    include ('navigation.php');

    $m='';
    $PassErr=$nPassErr=$cPassErr='';
    $conn=connect();

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    if(isset($_POST['submit'])){
        $Pass = $_POST["pass"];
        $nPass = $_POST["npass"];
        $cPass = $_POST["cpass"];
        if (empty($_POST["pass"])) {
            $passErr = "Password is required";
          } else {
            // check if name only contains letters and whitespace
           if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$Pass))
            {
              $PassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
              %)";
            }
          }
        
        
        
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["npass"])) {
            $nPassErr = "Password is required";
          } else {
            // check if name only contains letters and whitespace
           if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$nPass))
            {
              $nPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
              %)";
            }
            if($nPass==$Pass)
                    {
                      $nPassErr="New Password should not be same as the Current Password";
                    }
                  }
                
        
            //if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (empty($_POST["cpass"])) {
                $cPassErr = "Password is required";
              } else {
                // check if name only contains letters and whitespace
               if(!preg_match("/^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$cPass))
                {
                  $cPassErr ="Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,
                  %)";
                }
                if($cPass!=$nPass)
                    {
                      $cPassErr="New Password must match with the Retyped Password";
                    }
                }





        if($thisUser['password']==$_POST['pass']){
            $sq= "UPDATE users_info SET ";
            if(isset($_POST['uname'])){
                $uName= $_POST['uname'];
                if($uName!= $thisUser['name']){
                    $sq .= "name = '$uName',";
                }
            }
            if(isset($_POST['email'])){
                $uEmail= $_POST['email'];
                if($uName!= $thisUser['email']){
                    $sq .= "email = '$uEmail',";
                }
            }
            if(isset($_FILES['uavtr'])){
                $tmpName= $_FILES['uavtr']['tmp_name'];
                $uAvtr= $_FILES['uavtr']['name'];
                $size= $_FILES['uavtr']['size'];
                if($size<3000000){
                    $format= explode('.', $uAvtr);
                    $actualName= strtolower($format[0]);
                    $actualFormat= strtolower($format[1]);
                    $allowedFormat= ['jpeg', 'jpg', 'png', 'gif'];
                    $location = 'Users/'.$actualName.'.'.$actualFormat;
                    if($actualFormat=='jpg'||$actualFormat=='jpeg'){
                        $img= imagecreatefromjpeg($tmpName);
                        $resizedImage= imagescale($img, 300,200);
                        imagejpeg($resizedImage,$location,-1);
                    } elseif($actualFormat=='png'){
                        $img= imagecreatefrompng($tmpName);
                        $resizedImage= imagescale($img, 300,200);
                        imagepng($resizedImage,$location,-1);
                    } elseif($actualFormat=='gif'){
                        $img= imagecreatefromgif($tmpName);
                        $resizedImage= imagescale($img, 300,200);
                        imagegif($resizedImage,$location,-1);
                    }
                    $sq .="avatar='$location',";
                } else{
                    $m= "Image size should be less than 3MB";
                }
            }
            if(isset($_POST['npass'])&& $_POST['npass']!=''&& isset($_POST['cpass'])&& $_POST['cpass']!=''){
                if($_POST['npass']==$_POST['cpass']){
                    $pass= $_POST['npass'];
                    if($pass!=$thisUser['password']){
                        $sq .="password= '$pass',";
                        $m= 'Users Information Successfully Updated!';
                    }
                }else{
                    $m= "Credentials mismatch!";
                }
            }
            $sq= substr($sq, 0,-1);
            $sq .=" WHERE id='$id'";
            $conn->query($sq);
            //$m= 'Users Information Successfully Updated!';
        } else{
            $m= "Credentials mismatch!";
        }
    }

    $sql= "SELECT * from users_info";
    $res= $conn->query($sql);

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));
?>

<html>
    <head>
        <title> Users </title>
        <link rel="stylesheet" type="text/css" href="css/users.css">

        <script>
            function checkName(val){
    var checkName1= /^[0-9]/;
    var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(checkName1.test(val)){
        document.getElementById('checktext4').innerHTML='Must start with a letter!';
        document.getElementById('checktext').style.color='red';
    }
    else if(!checkName2.test(val))
    {
        document.getElementById('checktext4').innerHTML='At least two words and only contain letters,dash!';
        document.getElementById('checktext4').style.color='red';
    } else{
        document.getElementById('checktext4').innerHTML='';
    }
}


function checkEmail(val){
    var checkEmail1= /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkEmail1.test(val)){
        document.getElementById('checktext5').innerHTML='Invalid email format. Format: example@anything.com!';
        document.getElementById('checktext5').style.color='red';
    }
    else{
        document.getElementById('checktext5').innerHTML='';
    }
}


            function checkPass(val){
    var checkPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    if(!checkPass1.test(val)){
        document.getElementById('checktext1').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext1').style.color='red';
    }
    else{
        document.getElementById('checktext1').innerHTML='';
    }
}


function checkNPass(val){
    var checkrPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkrPass1.test(val)){
        document.getElementById('checktext2').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext2').style.color='red';
    }
    else if(document.getElementById("pass").value==document.getElementById("npass").value)
    {
        document.getElementById('checktext2').innerHTML="New Password should not be same as the Current Password!";
        document.getElementById('checktext2').style.color='red';
    }
    else{
        document.getElementById('checktext2').innerHTML='';
    }
    
}


function checkCPass(val){
    var checkrPass1= /^(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    //var checkName2= /^[a-zA-Z-. ?!]{2,}/;
    
    if(!checkrPass1.test(val)){
        document.getElementById('checktext3').innerHTML='Password must not be less than eight (8) characters and must contain at least one of the special characters (@, #, $,%)!';
        document.getElementById('checktext3').style.color='red';
    }
    else if(document.getElementById("npass").value!=document.getElementById("cpass").value)
    {
        document.getElementById('checktext3').innerHTML="New Password must match with the Retyped Password!";
        document.getElementById('checktext3').style.color='red';
    }
    else{
        document.getElementById('checktext3').innerHTML='';
    }
    
}
        </script>
    </head>
    <body>
    <div class="row" style="padding-top: 50px;">
        <div class="leftcolumn">
            <div class="row">
                <section style="padding-left: 20px; padding-right: 20px;">
                    <div class="col-sm-3">
                        <div class="card card-green">
                            <h3>Total Products </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_product?$total_product['total_products']: 'No Products available in stock'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow" >
                            <h3>Products Bought </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3 " >
                        <div class="card card-blue" >
                            <h3>Products Sold </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="card card-red" >
                            <h3>Available Stock </h3>
                            <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
                        </div>
                    </div>
                </section>
            </div>
            <div class="card">
                <div class="text-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                        Update Your Info
                    </button>
                    <h1><?php echo $m;?></h1>
                    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h2 class="modal-title" id="exampleModalScrollableTitle"><?php echo $thisUser['name']; ?></h2>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="users.php" enctype="multipart/form-data">
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="uname" class="pr-10"> User Name</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="uname" type="text" class="login-input" placeholder="User Name" onchange="checkName(this.value);" id="uname" value="<?php echo $thisUser['name']; ?>" required>
                                            </div>
                                        </div>
                                        <small id="checktext4" style="color: red;"></small>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="email" class="pr-10"> Email </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="email" type="text" class="login-input" placeholder="Email Address" onchange="checkEmail(this.value);" value="<?php echo $thisUser['email']; ?>" id="buy" required>
                                            </div>
                                        </div>
                                        <small id="checktext5"></small>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="uavtr" class="pr-10"> User Avatar</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="pl-20">
                                                    <input class="login-input" name="uavtr" type="file" id="uavtr" alt="Upload Image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="pass" class="pr-10"> Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="pass" class="login-input" type="password" id="pass" onchange="checkPass(this.value);">
                                    
                                            </div>
                                        </div>
                                        <span class="error">* <?php echo $PassErr;?></span>
                                        <small id="checktext1"></small>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="npass" class="pr-10">New Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="npass" class="login-input" type="text" id="npass" onchange="checkNPass(this.value);">
                                            </div>
                                        </div>
                                        <small id="checktext2"></small>
                                        <div class="form-group pt-20">
                                            <div class="col-sm-4">
                                                <label for="cpass" class="pr-10">Confirm New Password</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input name="cpass" class="login-input" type="text" id="cpass" onchange="checkCPass(this.value);">
                                            </div>
                                        </div>
                                        <small id="checktext3"></small>
                                        <div class="form-group" style="text-align: center;">
                                            <button type="submit" value="submit" name="submit" class="btn btn-success">Change</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_container">
                    <h1 style="text-align: center;">Users Table</h1>
                    <div class="table-responsive">
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead class="thead-light">
                            <tr>
                                <th data-field="date" data-filter-control="select" data-sortable="true">User</th>
                                <th data-field="examen" data-filter-control="select" data-sortable="true"> Email</th>
                                <?php
                                    if($thisUser['is_admin']==1){
                                        echo '<th data-field="note" data-sortable="true">Is Active</th>';
                                    }
                                ?>
                                <th data-field="note" data-sortable="true">Last Login Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysqli_num_rows($res)>0) {
                                while ($row = mysqli_fetch_assoc($res)) {

                                    echo '<tr>';
                                    echo '<td>'. $row['name'].'</td>';
                                    echo '<td>'. $row['email'].'</td>';
                                    if($thisUser['is_admin']==1) {
                                        if($row['is_active']=='1'){
                                            $active= "Active";
                                        } else{
                                            $active= "Inactive";
                                        }
                                        echo '<td>' . $active . '</td>';
                                    }
                                    echo '<td>'. date("Y-m-d h:i:sa",strtotime($row['last_login_time'])).'</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card  text-center" >
                <h2>About User</h2>
                <div style="height:100px;"><img src="<?php echo $thisUser['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Please Select your avatar"></div>
                <p><h4><?php echo $thisUser['name'];  ?></h4> is working here since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4></p>
            </div>
            <div class="card text-center">
                <h2>Owners Info</h2>
                <p>Some text..</p>
            </div>
        </div>
    </div>

    <?php include('footer.php')?>

    </body>
</html>