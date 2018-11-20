	<?php session_start();
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
?>
<?php
// This section of code checks for the users cart and provides information for later code
// check for what the user has in their cart in the cart table by searching for any entries with their email.  
  // Create connection
    $conn = new mysqli("$servername", "$username", "$password", "$dbname");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
$sql = "SELECT * FROM cart WHERE user='$email';";
$result = $conn->query($sql);

?>

<?php

// this section of php code handles deleting an object from the cart based on the hidden field in the table
 $conn = new mysqli("$servername", "$username", "$password", "$dbname");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

if(isset($_POST["rcart"])){

// get the name of the hidden fields
$dproduct = $_POST["pname"];
$dquantity = $_POST["pquantity"];

// delete the row with that product name
$sql = "DELETE FROM cart WHERE ProductTitle='$dproduct';";


if($conn->query($sql)===TRUE){
//echo "Product removed from cart";
 header('Location: Cart.php');




// This code is used to find the amount of stock for the item selected
$sqlcheck = "SELECT Quantity FROM Product WHERE ProductTitle='$dproduct';";
$qcheck = $conn->query($sqlcheck);
$qrow = $qcheck->fetch_assoc();
$qres = $qrow["Quantity"];

//adjust the quantity in the table 
$updateq = $qres + $dquantity;



$altersql = "UPDATE Product SET Quantity='$updateq' WHERE ProductTitle='$dproduct';";

$conn->query($altersql);

}
else{
echo "error";
}

}

$conn->close();

?>

<?php
// This section assembles a string of the products and quantities for the finished transaction table.
$productString = "";
	
 $conn = new mysqli("$servername", "$username", "$password", "$dbname");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

$get = "SELECT * FROM cart WHERE user = '$email';";
$getResult = $conn->query($get);


if($getResult->num_rows > 0){ 
while($getRow=$getResult->fetch_assoc()){
$title = $getRow["ProductTitle"];
$quant = $getRow["Quantity"];

$productString.=  $quant .= " ";
$productString.= $title .= ",";

	
}
}

$productString = substr($productString, 0, -1);	


$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cart</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />
</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page    </a>  <a href="Logout.php"> Logout </a>
</header>
<header>
<a href="HomePage.php"><img src="NIP.png" alt="Treee" style = "display:inline" width = "150" height = "150" /></a>
<p id="titl"><font size="+20">Welcome to Nature in a Pocket (NIP)</font></p>
</header>
<div class="shopping-cart">
<?php
// this section of code finds and displays what the user has in their cart. it uses a button and a hidden field to delete items from the cart



if ($result->num_rows > 0) {
    // if yes, output the users cart
	$subtotal = 0;
	echo "<table> <tr> <td> Product Name </td> <td> Quantity </td> <td> Price Per Unit </td><td>Price for all </td><td>Remove from cart </td></tr>";
    while($row = $result->fetch_assoc()) {
	// each row is a form with a hidden field that allows for the removal of a product from the cart
	echo "<form method='post' action='Cart.php'>";

	// display the product info
        echo "<tr><td>" . $row["ProductTitle"] . "</td><td>" . $row["Quantity"] . "</td><td> " . $row["Price"]. "</td> ";
// get the total price for that row
	$rowprice = $row["Quantity"] * $row["Price"];
	$subtotal = $subtotal + $rowprice;
	echo "<td>" . $rowprice . "</td>";

	echo "<td><input type='submit' value='remove from cart' name='rcart'></td>";
	echo "<input type='hidden' value=\"$row[ProductTitle]\" name='pname'>  ";
	echo "<input type='hidden' value=\"$row[Quantity]\" name='pquantity'></tr>";
	echo "</form>";
    }
echo "</table>";
echo "Subtotal: $" . $subtotal;

echo "<form method='post' action='Cart.php'>";
echo "<input type='submit' value='Confirm Purchase' name='purchase'>";
echo "</form>";

} else {
    echo "No items in cart";
}




$conn->close();

?>



</div>



</div>


<footer> © Nature In a Pocket 2018 </footer>

        
</html>


<?php

// This section of code completes the transaction.  It needs to add the cart info to the transaction table, delete the users cart, and email notify the user of the transaction succeeding via email
//if the user clicks purchase
if(isset($_POST["purchase"])){
 $conn = new mysqli("$servername", "$username", "$password", "$dbname");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


//create an sql statement to put the information into the transaction table
    $buy = "INSERT INTO transactions (user, Price, Description) VALUES ('$email', '$subtotal', '$productString');";

    $buyResult = $conn->query($buy);
    if($buyResult){
    // if the user successfully finished the transaction, then delete the users cart and send them to a confirmation page.
echo "success";
$delete = "DELETE FROM cart WHERE user='$email'";
// finish that part later
$emptyResult = $conn->query($delete);

// send email to user
// the message
//$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

// send email
//mail("$dbname@uregina.ca","My subject",$msg);
// redirect

header('Location: Confirm.php');


}
else {
	echo "an unexpected error has occured.  Please try again later";
}



}

$conn->close();
?>
