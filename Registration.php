
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration page</title>

<link rel="stylesheet" type="text/css" href="MyStyleA.css"/>
</head>
<body>
<header class="login">
<a href="Login.php"> Login</a> 
</header>
<header>
<img src="NIP.jpg" alt="Treee" style = "display:inline" width = "150" height = "150" />

</header>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) { 
}


// define variables and set to empty values
$now = date("Y-m-d H:i:s");
$firstNameErr = $lastNameErr = $emailErr = $passwordErr = $cpasswordErr = $dobErr = $createErr = "";
$firstName = $lastName = $email = $password = $cpassword = $dob = "";
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


 if (empty($_POST["firstname"])) {
    $firstNameErr = "Name is required";
    $valid = false;
  } else {
    $firstName = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters allowed"; 
      $valid = false; 
   }
  }
  
  if(empty($_POST["lastname"])){
   $lastNameErr = "Last name is required";
   $valid = false; 
} else {
   $lastName = test_input($_POST["lastname"]);
   if (!preg_match("/^[a-zA-Z ]*$/",$lastName)){
   $lastNameErr = "Only letters allowed";
     $valid = false; 
}
}

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
     $valid = false; 
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
     $valid = false;  
    }
  }
    
if(empty($_POST["password"])){
    $passwordErr = "Must enter a password of 8 characters";
     $valid = false; 
}
else{
    $password = test_input($_POST["password"]);
    if(!preg_match("/^(\S*)?\d+(\S*)?$/",$password)){
    $passwordErr = "Only letters and numbers allowed";
     $valid = false; 
}
    if(strlen($password) != 8){
    $passwordErr = "Password must be 8 characters long";
     $valid = false; 
} 
}

if(empty($_POST["cpassword"])){
   $cpasswordErr = "Please confirm your password";
     $valid = false; 
}
   else{
   $cpassword = test_input($_POST["cpassword"]);
}
   if($password != $cpassword){
   $cpasswordErr = "Passwords must match";
     $valid = false; 
}
  
if(empty($_POST["dob"])){
   $dobErr= "Enter a date of birth";
     $valid = false; 
}
else{
   $dob = test_input($_POST["dob"]);
  if (!preg_match("/[0-9]{2}\\/[0-9]{2}\\/[0-9]{2}/", $dob)){
   $dobErr= "Format in mm/dd/yy";
   $valid = false;
}
}

$sql = "SELECT email FROM user WHERE email='$email';"; 

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
 $valid = false;
 $createErr = "Email already exists!";
}

if($valid){ // if input is legal, open database for insertion

$sql = "INSERT INTO user (fname, lname, email, password, dob)
VALUES('$firstName', '$lastName', '$email', '$password', '$dob');";

if(mysqli_query($conn, $sql)){

mysqli_close($conn);

header('Location: Login.php');
exit();
}

else{
echo "Error in sqli";
mysqli_close($conn);
}
}


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</div>
<article>
<h3> Sign up form </h3>
<p> Please fill in all fields </p>
<form method="post" action="Registration.php">

<label id="namemsg">  </label>
First Name: <input type="text" name="firstname" /> <br />
<span class="error"> <?php echo "$firstNameErr <br />" ?> </span>
<label id="lnamemsg"> </label>
Last Name: <input type="text" name="lastname" /> <br />
<span class="error"> <?php echo "$lastNameErr <br />" ?> </span>
<label id="usernamemsg"> </label>
<label id="dobmsg"> </label>
Date of Birth (MM/DD/YY):  <input type="text" name="dob" /> <br />
<span class="error"> <?php echo "$dobErr <br />" ?> </span>

Email: <input type="text" name ="email" /> <br />
<span class="error"> <?php echo "$emailErr <br />" ?> </span>
<label id="passwordmsg"> </label>
Password (8 characters): <input type="password" name = "password" /> <br />
<span class="error"> <?php echo "$passwordErr <br />" ?> </span>
<label id="password_rmsg"> </label>
Confirm Password: <input type ="password" name ="cpassword" /> <br />
<span class="error"> <?php echo "$cpasswordErr <br />" ?> </span>

<input type="submit" value="Sign Up" />
</form>
<span class = "error"> <?php echo "$createErr" ?> </span>
<!--<script type="text/javascript" src="assign2.js"> </script>-->
</article>

<footer> © Nature In a Pocket 2018 </footer>
</body>
<script type="text/javascript" src="validation.js"></script>
</html>
