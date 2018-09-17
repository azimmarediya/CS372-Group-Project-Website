<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Profile</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />
<script type="text/javascript" src="validation.js"></script>
</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page    </a>   <a href="Cart.php">  Cart</a>
</header>
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
<a href="Product.php"> Product list</a>
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
<form id="Pop" onsubmit ="return PopUp()" method="post">
<table>
<col width="130">
<col width="630">
<col width="630">
<tr>
<th>
<div id="eco">

<?php

	$db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}
$email = $_SESSION["email"];



$q = "select * from OnlineStore where email = '$email'";	

$result = $db->query($q);

if ($result->num_rows > 0)
	
{
	$row = $result->fetch_assoc();
	echo " Frist Name: ". $row["firstname"]. "<br>";
	echo " Last Name: ". $row["lastname"]. "<br>";
	echo " Date of Birth: ". $row["dateofbirth"]. "<br>";
	
	
} else {
    echo "0 results";
}

?>
 <img src="<?php echo  $row["image"]; ?>" width = "150" height = "150"/> 
    

       <p> <A href="edit.html" >Edit Profile</A>

        <A href="Logout.php" >Logout</A></p>
      </div> 
      </th>
      
      </tr>
      <tr>
      <th>
      <p> Wish list </p>
      </th>
      <th>
      <div class="product-grid__product-wrapper">
					<div class="product-grid__product">
						<div class="product-grid__img-wrapper">			
							<img src="CenCar.jpg" alt="Img" class="product-grid__img" />
						</div>
						<span class="product-grid__title">Centrum Cardio</span>						
						<span class="product-grid__price">18.49$</span>
						<div class="product-grid__extend-wrapper">
							<div class="product-grid__extend">
								<p class="product-grid__description">Centrum Cardio is a complete multivitamin for healthy cholesterol levels and a healthy heart.</p>
								<span id="myPopup" onclick="Remt()" class="product-grid__btn product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i> Remove item</span>				
								
							</div>
						</div>
					</div>
				</div>
				<!-- end Single product -->

				<div class="product-grid__product-wrapper">
					<div class="product-grid__product">
						<div class="product-grid__img-wrapper">			
							<img src="CenMuWo.jpg" alt="Img" class="product-grid__img" />
						</div>
						<span class="product-grid__title">Centrum For Women</span>						
						<span class="product-grid__price">21.99$</span>
						<div class="product-grid__extend-wrapper">
							<div class="product-grid__extend">
								<p class="product-grid__description">A balanced diet is important for every woman to look and feel her best. That’s why Centrum for Women is formulated to address the unique nutritional demands of today’s woman.</p>
								<span id="myPopup" onclick="Remt()" class="product-grid__btn product-grid__add-to-cart"><i class="fa fa-cart-arrow-down"></i> Remove item</span>						
								
							</div>
						</div>
					</div>
				</div>
      
      </th>
      </tr>
  </table>
  </form>
</body>
<footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>
	
	<footer> © Nature In a Pocket 2018 </footer>
	<script type="text/javascript" src="validation.js"></script>
</html>

