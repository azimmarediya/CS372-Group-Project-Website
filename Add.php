<?php  
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

session_start();
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
}

else {header('Location:HomePage.php');
}
?>

<?php
// This section handles form validation

$productNameErr = $categoryErr = $quantityErr = $priceErr = $addErr = "";
$productName = $categoryName = $quantity = $price = "";
$valid = true;

if (isset($_POST[addP])) {



 if (empty($_POST["productname"])) {
    $productNameErr = "Please enter a product name";
    $valid = false;
  } else {
    $productName = test_input($_POST["productname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$productName)) {
      $productNameErr = "Please only use letters"; 
      $valid = false; 
   }
  }

if (empty($_POST["categoryname"])) {
    $categoryNameErr = "Please enter a category name";
    $valid = false;
  } else {
    $categoryName = test_input($_POST["categoryname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$categoryName)) {
      $categoryNameErr = "Please only use letters allowed"; 
      $valid = false; 
   }
  }

if (empty($_POST["quantity"])) {
    $quantityErr = "Please enter a quantity is required";
    $valid = false;
  } else {
 $quantity = test_input($_POST["quantity"]);
if($_POST["quantity"] < 0){
   $quantityErr = "Please enter a valid number for the quantity";
   $valid = false;
}
}

if (empty($_POST["price"])) {
    $priceErr = "Please set a price";
    $valid = false;
  } else {
 $price = test_input($_POST["price"]);
if($_POST["price"] < 0){
   $priceErr = "Please enter a valid number for the price";
   $valid = false;
}
}

// Check if the product already exists
$check = "SELECT ProductTitle FROM Product WHERE ProductTitle = '$productName';"; 

$result = mysqli_query($conn, $check);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
 $valid = false;
 $addErr = "Product already exists!";
}


if($valid){ //if the input is valid
$sql = "INSERT INTO Product (ProductTitle, Category, Quantity, Price)  VALUES ('$productName', '$categoryName', '$quantity', '$price')";

if($conn->query($sql)===TRUE){

//echo "Product added to cart";
 header('Location: Admin.php');


}


}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// This section is to allow the user to return if they change their mind or didn't mean to click the button
if(isset($_POST["return"])){
header('Location:Admin.php');
}
?>

<html>
<head>
<title> Edit products </title>
<style>
aside.form
{
background-color:lightgrey;
}
span.error{
	color:red;
}
</style>
</head>

<body>
<aside class="form">
		<h1> Fill in the form to add product </h1>
	<form method="post" action="Add.php">

<label id="namemsg">  </label>
Product Name: <input type="text" name="productname" /> <br />
<span class="error"> <?php echo "$productNameErr <br />" ?> </span>
Category: <input type="text" name ="categoryname" /> <br />
<label id="categorymsg"> </label>
<span class="error"> <?php echo "$categoryNameErr <br />" ?> </span>
<label id="quantitymsg"> </label>
Quantity: <input type="text" name = "quantity" /> <br />
<span class="error"> <?php echo "$quantityErr <br />" ?> </span>
<label id="pricemsg"> </label>
Price: <input type ="text" name ="price" /> <br />
<span class="error"> <?php echo "$priceErr <br />" ?> </span>

<input type="submit" value="Add" name="addP" />
<br /> <br /> <br />
<input type="submit" value="Return to Admin Page" name="return" />
</form>
<span class = "error"> <?php echo "$addErr" ?> </span>

</aside>


</body>
</html>
