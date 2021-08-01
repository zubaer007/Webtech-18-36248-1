<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
</head>
<body>
<?php

include 'db_connect.php';
$conn=db_conn();
$append='';

if(isset($_POST['save']))
{
    $name = $_POST["name"];
$buying = $_POST["buying"];
$selling = $_POST["selling"];
if (empty($_POST["display"]))
{
    $display='No';
}
else{
$display = $_POST["display"];
}

    $sql="INSERT INTO products(name, buying, selling, display) 
    values('$name','$buying','$selling','$display')";
    //$append="hdgdsjgfsj";
    if($conn->query($sql)===true)
    {
        $append="successful";
    }
    else{
        $append="Error";
    }


    //header("location:addProductdb.php");
}
 ?>
<form method="post">
  <fieldset style="width:20%; margin-left:35%;">
    <legend><h1>ADD PRODUCT</h1></legend>
    <label for="name">Name</label><br>
    <input type="text" name="name"><br><br>
    <label for="buying">Buying Price</label><br>
    <input type="text" id="buying" name="buying"><br><br>
    <label for="selling">Selling Price</label><br>
    <input type="text" id="selling" name="selling"><br><br>
    <input type="checkbox" id="display" name="display" value="Yes">
<label for="display"> Display</label><br><br>
<span><?php echo $append; ?></span>
<input type="submit" name="save" value="Save" style="width: 100px">
  </fieldset>
</form>


</body>
</html>