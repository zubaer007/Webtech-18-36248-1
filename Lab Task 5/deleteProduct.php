<!DOCTYPE html>
<html>
<head>
<title>Delete Product</title>
</head>
<body>
<?php

include 'db_connect.php';
$conn=db_conn();
$append='';
$nameChange = $_GET['name'];
$sql1 = "SELECT * FROM products where name='$nameChange'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $name=$row['name'];
      $buying=$row['buying'];
      $selling=$row['selling'];
      $display=$row['display'];
  }}

if(isset($_POST['delete']))
{

    $sql2="DELETE from products where name='$nameChange'";
    //$append="hdgdsjgfsj";
    if($conn->query($sql2)===true)
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
    <legend><h1>DELETE PRODUCT</h1></legend>
    Name: <?php echo $name; ?><br><br>
    Buying Price: <?php echo $buying; ?><br><br>
    Selling Price: <?php echo $selling; ?><br><br>
Displayable: <?php echo $display; ?></label><br><br>
<span><?php echo $append; ?></span>
<input type="submit" name="delete" value="Delete" style="width: 100px">
  </fieldset>
</form>


</body>
</html>