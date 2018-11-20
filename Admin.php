<?php  
session_start();
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect("$servername", "$username", "$password", "$dbname");
$email = $_SESSION["email"];
  
$sql = "SELECT email FROM user WHERE email='$email';"; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)<1){
mysqli_close($conn);
 header('Location: Login.php');
exit();
} 

//check if user has admin privilleges
$sql = "SELECT Admin FROM user WHERE email='$email';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row["Admin"]=="yes"){
//echo "user is an admin";
}

else {header('Location:HomePage.php');
}
?>
<?php
//This section of code handles the add/remove category

if(isset($_POST["addbutton"])){
if(empty($_POST["addc"])){
$notify = "Please enter a category name";
}
else{
	$add = $_POST["addc"];


$ccheck = "SELECT * FROM categories WHERE categoryname='$add';";
$cres= $conn->query($ccheck);
$num = mysqli_num_rows($cres);

if(mysqli_num_rows($cres) > 0){
$notify="This category already exists";
}
else{
$addsql = "INSERT INTO categories VALUES ('$add');";
//$conn->query($addsql);
echo $cres->mysqli_num_rows;
$notify="Category has been added";
}
}
}
if(isset($_POST["removebutton"])){
if(empty($_POST["removec"])){
$notify = "Please enter a category name";
}
else{
$remove=$_POST["removec"];

$ccheck = "SELECT * FROM categories WHERE categoryname='$remove';";
$cres= $conn->query($ccheck);
if(mysqli_num_rows($cres) < 1){
$notify="This category did not exist";
}
else{
$removesql="DELETE FROM categories WHERE categoryname='$remove';";

$conn->query($removesql);
$notify = "Category has been removed";
}
}
}

?>

<?php
// This section of code checks if the admin wants to add product

if(isset($_POST["addp"])){
header('Location:Add.php');


}
?>

<?php
// This section of code checks if the admin wants to remove a product
if(isset($_POST["rlist"])){

// get the name of the hidden fields
$dproduct = $_POST["pname"];


// delete the row with that product name
$sql = "DELETE FROM Product WHERE ProductTitle='$dproduct';";


if($conn->query($sql)===TRUE){
//echo "Product removed from cart";
 header('Location: Admin.php');

}
}
?>
<?php
// this section of code allows the admin to put more quantity in without having to delete the product.
if(isset($_POST["restock"])){
$restock = $_POST["requant"];

if($restock < 0 ){
$error = "invalid number";
echo $error;
}
else{
$rproduct = $_POST["pname"];
$stockql = "UPDATE Product SET Quantity='$restock' WHERE ProductTitle='$rproduct' ;";
$stockres = $conn->query($stockql);
echo $stockql;
if($stockres){
header('Location:Admin.php');
}
}

}

?>

<!DOCTYPE html>
<html>
<head>



<?php


$conn = new mysqli($host, $username, $password, $databasename);
if($conn->connect_error){
	die("connection failed: " . $conn->connect_error);
}




?>
<meta charset="UTF-8">
<title>Admin</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />


</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page</a> <a href="Logout.php"> Logout</a>
</header>
<header>
<a href="HomePage.php"><img src="NIP.png" alt="Treee" style = "display:inline" width = "150" height = "150" /></a>
<p id="titl"><font size="+20">Welcome to Nature in a Pocket (NIP)</font></p>
</header>


<section class="edit">
<!-- This section will display the product information for the admin to edit -->
<h3> Edit Product </h3>

<?php
// Gather the information from the Product table and display it for editting
// run query to display product information later
$sql = "SELECT * FROM Product;";
$result= $conn->query($sql);
if($result->numrows > 1){
$error = "No products to display!";
echo $error;
echo $sql;
}
else{
// set up the table

echo "<table> <tr> <th> Product Name </th> <th> Category </th> <th> Quantity </th>  <th> Price </th><th colspan='2'> Restock </th> <th> Remove from store </th> </tr>";
//output each row

while ($row = $result->fetch_assoc()){
	echo "<form action='Admin.php' method='post'>";
	echo "<tr><td>" . $row["ProductTitle"]. "</td><td>" . $row["Category"]. "</td><td>" . $row["Quantity"]. "</td><td>" . $row["Price"] . "</td>";
	echo "<td> <input type='number' min='0' value = '0' name = 'requant'> </td>";
	echo "<td> <input type='submit' value='restock' name='restock' </td>";
	echo "<td><input type='submit' value='remove from list' name='rlist'></td>";
	echo "<input type='hidden' value=\"$row[ProductTitle]\" name='pname'> </td> ";
	echo "</form>";

}
	echo "</table>";
}
	echo "<form action='Admin.php' method='post'>";
	echo "<input type='submit' value='add product' name='addp'>";
	echo "</form>";
?>

</section>

<br>
<!----------------------------------------------------->
<!-- This section is for the add/remove category -->
<aside class="edit">
	<form method="post" action="Admin.php">
	<table>
	<tr>
	<td>Add Category:</td> <td> <input type="text" name="addc"> </td><td> <input type="submit" class="button" name="addbutton" value="add category"></td>
	</tr>
	<br>
	<tr>
	<td>Remove Category:</td><td> <input type="text" name="removec"></td><td> <input type="submit" class="button" name="removebutton" value="remove category"></td>
	</tr>
	</table>
<?php
echo $notify;
?>
	
</aside>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------->
<!-- This section displays the completed transactions -->

<aside class="trans">
<?php
// Create connection
    $conn = new mysqli("$servername", "$username", "$password", "$dbname");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

// This section of code will gather the information from the completed transaction table and present it.
$tran = "SELECT * FROM transactions ORDER BY id;";
$tranres = $conn->query($tran);


while($tranrow = $tranres->fetch_assoc()){
	$counter = 0;
	if($counter==0){
		echo "<h3> transaction id: " . $tranrow["id"] . " User: " . $tranrow["user"] . " </h3> "; 
		echo "<table> <tr> <td> Total </td>  <td> Description </td> </tr>";
	}
	
	echo "<tr> <td>" . $tranrow["Price"] . "</td>  <td>" . $tranrow["Description"] . "</td></tr>";
	echo "</table>";
}
echo "</table>"

?>


</aside>









<!--------------------------------------------------------------------------------------------->


  
