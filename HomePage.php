
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
  
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">Submit</button>
    </form>    
  </div> 

<div class="vertical-menu">
  <a href="#" class="active">Category</a>
  <?php 		
    // Create connection
    $conn = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT Category FROM Categories";
   

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
<section>
	
		<h2 id = "testing">Login</h2>
		<p>Welcome to NIP! Login please to make any purchases </p>
		<br/>
		<form id = "login" onsubmit ="return login()" action="HomePage.php" method="post">
		<input type="hidden" name="submitted" value="1"/>
			<table>				
					<tr><td>Email: </td><td> <input type="text" id="email" name="email" size="30" /></td></tr>					
				
					<tr><td>Password: </td><td> <input type="password" id="password" name="password" size="30" /></td></tr>  			
				<tr>
		<td>No account? <a href="Registration.php">Sign up</a></td>
		</tr>
			</table>	
		
		<br/>
		<br/>
		
		<input class = "ordinaryLink submitButton" type = "submit" value = "Login"/>
		
		</form>
		<br/>
		<br/>
		<br/>
	
</section>







<?php
$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);

	$db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	//add code here to select * from table User where email = '$email' AND password = '$password'
	// start with
	$q = "select * from OnlineStore where email = '$email' and password = '$password'";
	 
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
		if($email == "admin@uregina.ca")
		{
		session_start();
		$_SESSION["email"] = $row["email"];
		header("Location: Admin.php");
		$db->close();
		exit();
		}
		else
		{
			session_start();
			$_SESSION["email"] = $row["email"];
			header("Location: Profile.php");
			$db->close();
			exit();
		}
	}
	else
	{
		$error = "The email/password combination was incorrect. Login failed.";
		echo "<script type='text/javascript'>alert('$error');</script>";
		$db->close();
	}
}

?>
<div id ="home" class="LIST">
<?php 		
    // Create connection
    $conn = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT ProductTitle, Category,  Quontity FROM Product";
   

		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<table><tr><th>Product Name</th><th>Category</th><th>Quontity</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>" . $row["ProductTitle"]. "</td><td>" . $row["Category"]. "</td><td>" . $row["Quontity"]. "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
		
		$conn->close();
?>
</div>
	<footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>
   
<footer> © Nature In a Pocket 2018 </footer>
<script type = "text/javascript"  src = "validation.js" ></script>
</body>

</html>
