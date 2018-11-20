<?php  
session_start();
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
$conn = mysqli_connect($servername, $username, $password, $dbname);
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
$admin = "yes";
}


?>

<?php
//this section is for moving the customers purchases from the product table to the cart table.  It uses a hidden value to track the product name and tracks the quantity value using php variables
 // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

$error = "";

if(isset($_POST["purchase"])){
// get the name for the row selected from the hidden field
$pproduct = $_POST["pname"];
// get the quantity from the number in the box;
$pquantity = $_POST["pquantity"];

// This code is used to find the amount of stock for the item selected
$sqlcheck = "SELECT Quantity FROM Product WHERE ProductTitle='$pproduct';";
$qcheck = $conn->query($sqlcheck);
$qrow = $qcheck->fetch_assoc();
$qres = $qrow["Quantity"];

// This code is used to check that the product is not already in the cart
$sqlcheck2 = "SELECT ProductTitle FROM cart WHERE ProductTitle='$pproduct' AND user='$email';";
$ncheck = $conn->query($sqlcheck2);
$nres = $ncheck->num_rows;


// need to check that the quantity is not less than 1 so we are not adding nothing to the cart
if($pquantity<1)
{
$error = "Please specify a quantity";
echo $error;
}
// need to check that the quantity selected is not greater than the amount in stock
else if($pquantity > $qres)
{
$error ="There is not enough stock for this purchase.  Please select an amount lower than the available quantity";
echo $error;
}
// need to check that the item is not already in the customers cart
else if($nres > 0){
$error = "This item is already in your cart.  Please first remove it to change your order";
echo $error;
}

else{


$pprice = $_POST["pcost"];

// add the required values into the users cart
$sql = "INSERT INTO cart values ('$email', '$pproduct', '$pquantity', '$pprice');";

if($conn->query($sql)===TRUE){
echo "Product added to cart";

//adjust the quantity in the table to prevent other users from trying to purchase drugs we don't have.  
$updateq = $qres - $pquantity;


$altersql = "UPDATE Product SET Quantity='$updateq' WHERE ProductTitle='$pproduct';";
$conn->query($altersql);

}
else{
echo "error";
}
}
}
$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<title>NIP Nature In a Pocket</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />
</head>
<body>




<header>
<img src="NIP.jpg" alt="Treee" style = "display:inline" width = "150" height = "150" />
<p id="titl"><font size="+20">Welcome to Nature in a Pocket (NIP)'s website</font></p>

</header>
  <header class="login">
 <a href="Cart.php"> Cart</a> <?php if($admin == "yes"){echo "<a href='Admin.php' > Admin </a>";} ?> <a href="Logout.php"> Logout </a>
</header>



<div class="vertical-menu">
  <a href="#" class="active">Category</a>



  <?php 		
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT Category FROM Product";
   

		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		   
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<a href='%'>" . $row["Category"]. "</a>";
		    }
		 
		} else {
		    echo "0 results";
		}
		
		$conn->close();
?>	
</div>




<div id ="home" class="LIST">
<?php 		
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT ProductTitle, Category,  Quantity, Price FROM Product ORDER BY Category";
   //   $sql = "SELECT * FROM PRODUCT";
 
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		// start the form and table
		
		    echo "<center><table><tr><th>Product Name</th><th>Category</th><th>Quantity</th><th>Price</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
			echo "<form method='post' action='HomePage.php'>";
		
		        echo "<tr><td>" . $row["ProductTitle"]. "</td><td>" . $row["Category"]. "</td><td>" . $row["Quantity"]. "</td><td>" . $row["Price"] . "</td>";
		
			echo "<td><input type='number' value='0' name='pquantity'>";
			echo " <input type='submit' value='add to cart'  name='purchase'>";
			echo "<input type='hidden' value=\"$row[ProductTitle]\" name='pname'>";
			echo "<input type='hidden' value=\"$row[Price]\" name='pcost'> </td></tr>";
	echo "</form>";		
    }
		    echo "</table></center>";
		
		} else {
		    echo "0 results";
		}
		
		$conn->close();
?>
</div>

   
<footer> © Nature In a Pocket 2018 </footer>
<script type = "text/javascript"  src = "validation.js" ></script>
</body>

</html>

