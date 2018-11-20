	<?php session_start();
	
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

?>
<html>

<head> <meta http-equiv="refresh" content="5; URL=HomePage.php">
</head>
<body>
<h1> Your Purchase is complete.  Your bill will be sent at the end of the month. </h1> 
<p> redirecting to home.... </p>
</body>


