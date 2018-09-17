
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration page</title>

<link rel="stylesheet" type="text/css" href="MyStyleA.css"/>
</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page    </a> <a href="Login.html"> Login</a> <a href="Cart.html">  Cart</a>
<a href="ProfilePage.html"> Profile</a>
</header>
<header>
<img src="NIP.jpg" alt="Treee" style = "display:inline" width = "150" height = "150" />

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
<h1>Registration page</h1>
<form id="Registration" onsubmit ="return RegistrationForm()" action="Registration.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="submitted" value="1"/>
<table>
	<tr><td>First Name: </td><td> <input type="text" id = "fname" name="fname" size="30" /></td></tr>
	<tr><td>Last Name: </td><td> <input type="text" id = "lname" name="lname" size="30" /></td></tr>
	<tr><td>Date of Birth: </td><td> <input type="text" id="date" name="date" size="30" /></td></tr>
 	<tr><td>Email: </td><td> <input type="email" id = "email" name="email" size="30" /></td></tr> 	
 	<tr><td>Password: </td><td> <input type="password" name="password" size="30" /></td></tr>      
 	<tr><td>Confirm Password: </td><td> <input type="password" id="Cpassword" name="Cpassword" size="30" /></td></tr>         
</table>
<div>
  <input type="file" id = "pic" name="pic"> 
</div>  
<input type="submit" name="Registration" value="Registration" /><input type="reset" value="Reset"/>
</form>
<script type="text/javascript" src="validation.js"></script>
</section>
<footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>

<footer> © Nature In a Pocket 2018 </footer>
</body>
<script type="text/javascript" src="validation.js"></script>
</html>

<?php

$validate = true;
$error = "";
$reg_fname = "/^[a-zA-Z0-9_-]+$/";
$reg_lname = "/^[a-zA-Z0-9_-]+$/";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Bday = "/^\d{1,2}\/\d{1,2}\/\d{4}$/";
$email = "";
$date = "mm-dd-yyyy";


if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $Fname = trim($_POST["fname"]);
    $Lname = trim($_POST["lname"]);
    $date = trim($_POST["date"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);    
    $pic = trim($_POST["pic"]);
    
       
       
    $db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
        echo "Connection failed";
    }
    
    $q1 = "SELECT * FROM OnlineStore WHERE email = '$email'";
    $r1 = $db->query($q1);

    // if the email address is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
        
    }
    else
    {
    	$fnameMatch = preg_match($reg_fname, $Fname);
    	if($Fname == null || $Fname == "" || $fnameMatch == false)
    	{
    		$validate = false;
    		
    	}
    	$lnameMatch = preg_match($reg_lname, $Lname);
    	if($Lname == null || $Lname == "" || $lnameMatch == false)
    	{
    		$validate = false;
    		
    	}
    	
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
           
        }
        $bdayMatch = preg_match($reg_Bday, $date);
        if($date == null || $date == "" || $bdayMatch == false)
        {
        	$validate = false;
        	
        }
              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen< 8 || $pswdMatch == false)
        {
            $validate = false;
           
        }

     
       
    }

    if($validate == true)
    {
    	
    	$dateFormat = date("Y-m-d", strtotime($date));
        //add code here to insert a record into the table User;
        // table User attributes are: email, password, DOB
        // variables in the form are: email, password, dateFormat, 
        $q2 = "insert into OnlineStore (firstname, lastname, dateofbirth, email, password, image) values ('$Fname', '$Lname', '$dateFormat', '$email', '$password','$pic')";
      

        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: HomePage.php");
            $db->close();
            exit();
           
        }else { echo "shit happens here";}
    }
    else
    {
        $error = "email address is not available. Signup failed.";
        $db->close();
        
    }

}
?>