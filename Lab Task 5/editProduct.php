<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
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
  }}

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

    $sql2="UPDATE products set name='$name', buying=$buying, selling=$selling, display='$display' where name='$nameChange'";
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
    <legend><h1>EDIT PRODUCT</h1></legend>
    <label for="name">Name</label><br>
    <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
    <label for="buying">Buying Price</label><br>
    <input type="text" id="buying" name="buying" value="<?php echo $buying; ?>"><br><br>
    <label for="selling">Selling Price</label><br>
    <input type="text" id="selling" name="selling" value="<?php echo $selling; ?>"><br><br>
    <input type="checkbox" id="display" name="display" value="Yes">
<label for="display"> Display</label><br><br>
<span><?php echo $append; ?></span>
<input type="submit" name="save" value="Save" style="width: 100px">
  </fieldset>
</form>


</body>
</html>