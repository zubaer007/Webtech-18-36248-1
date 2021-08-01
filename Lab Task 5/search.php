<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
}
</style>
</head>

<body>
<form method="post">
  <fieldset style="width:20%; margin-left:35%;">
    <legend><h1>SEARCH</h1></legend>
    <input type="text" name="name">
    
<input type="submit" name="search" value="Search By Name" style="width: 150px"><br><br>

</form>

    <table style="width:100%">
  <tr>
    <th>Name</th>
    <th>Profit</th> 
    <th></th>
  </tr>
  <?php
  include 'db_connect.php';
  $conn=db_conn();
  if(isset($_POST['search']))
{
    $name = $_POST["name"];
  $sql = "SELECT * FROM products where name='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $profit=$row['selling']-$row['buying'];
      echo "<tr><td>".$row["name"]."</td><td>".$profit."</td><td>";
      //.$row["name"]."</td><td>".$row["name"]."</td></tr>";
      ?>
      <a href="editProduct.php?name=<?php echo $row['name']; ?>">edit</a></td><td>
      <a href="deleteProduct.php?name=<?php echo $row['name']; ?>">delete</a></td></tr>
      <?php
  }}
}
   ?>
  
</table>
  </fieldset>
</body>

</html>