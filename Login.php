<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";
$error = "";

if (isset($_POST["signIn"]))
{
	if($_POST["check-me"] == 1) {
	
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);

	$db = new mysqli($servername, $username, $password, $dbname);
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	//add code here to select * from table User where email = '$email' AND password = '$password'
	// start with
	$q = "select email, password FROM user Where email = '$email' and password = '$password'";
	 
	$r = $db->query($q);
	$row = $r->fetch_assoc();
	if($email != $row["email"] && $password != $row["password"])
	{
		$validate = false;
	}
	else
	{
		$emailMatch = preg_match($reg_Email, $email);
		if($email == null || $email == "" || $emailMatch == false)
		{
			$validate = false;
		}

		$pswdLen = strlen($password);
		$passwordMatch = preg_match($reg_Pswd, $password);
		if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
		{
			$validate = false;
		}
	}

	if($validate == true)
	{

		session_start();
		$_SESSION["email"] = $email;
		header("Location: HomePage.php");
		$db->close();
		exit();
	}
	else
	{
		$error = "The email/password combination was incorrect. Login failed.";
		$db->close();
	}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Login</title>
	
	<link rel="stylesheet" type="text/css" href="MyStyleA.css"/>
	<script src = "validation.js" ></script>
    
</head>

</header>
<header>
<img src="NIP.jpg" alt="Treee" style = "display:inline" width = "150" height = "150" />

</header>

<body>


	<section>
	
		<h2 id = "testing">Login</h2>
		<p>Welcome to NIP! Please login to make any purchases </p>
		<br/>
		<form id = "login" action="Login.php" method="post">
			<table>		
				<tr colspan="2"><td><?php echo $error;?></td></tr>
					<tr><td>Email: </td><td> <input type="text" id="email" name="email" size="30" /></td></tr>					
				
					<tr><td>Password: </td><td> <input type="password" id="password" name="password" size="30" /></td></tr>  			
				
			</table>	
		
		<br/>
		<br/>
			<input type="hidden" name="check-me" id="check-me" value="1">
		
		<input class = "ordinaryLink submitButton" name="signIn" type = "submit" value = "Login"/>
		
		<p> No account? <a href="Registration.php">Sign up</a></p>
	
		</form>
		<br/>
		<br/>
		<br/>
	
	</section>

	
	<hr/>
	
	

	<script type = "text/javascript"  src = "validation.js" ></script>
	<!--<footer><a href="AdministratorPage.html">  Administrator Page</a></footer> -->
<footer> © Nature In a Pocket 2018 </footer>
</body>
</html>

