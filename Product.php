<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<meta charset="UTF-8">
<title>List of products</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />
</head>
<body>
<header class="login">
<a href="Profile.php"> Profile</a><a href="Cart.php">  Cart</a>
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
<form id = "login" action="Product.php" method="post">
		<input type="hidden" name="submitted" value="1"/>
<div class="wrapper" align="center">
	<div class="desc">
		<h1>Avalible product list</h1>		
	</div>

	<div class="content">
		<!-- content here -->
		<div class="product-grid product-grid--flexbox">
			<div class="product-grid__wrapper">
				<!-- Product list start here -->
				

<?php 		
    // Create connection

    $conn = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM Product";
    

		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<table><tr><th>Id</th><th>Product Name</th><th>Category</th><th>Description</th><th>Quontity</th><th>Price</th></tr>";
		    // output data of each row
		    
		    while($row = $result->fetch_assoc()) {
				$di = $row["id"];
		        echo "<tr><td>". $row["id"]. "</td><td>" . $row["ProductTitle"]. "</td><td>" . 
		        $row["Category"]. "</td><td>" . $row["Description"]. "</td><td>". $row["Quontity"]. "</td><td>". $row["Price"]. "</td><td>".
		        
		         "<button id = $di onclick='AddCart(this.id)'>Add to Cart</button>"."</td><td>". 
		         
		        "<input id = '$di + 10' onsubmit ='return AddWish()' type='Submit' value='Add to Wish List'>"."</td></tr>" ;		        
		       
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
		
		$conn->close();
	?>

			
			</div>		
		</div>
		
	</div>


	
</div>
</form>
<footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>

<footer> © Nature In a Pocket 2018 </footer>
<script type = "text/javascript"  src = "validation.js" ></script>
</body>
</html>
<?php 	
		    $x = intval($_POST['q']);
		    
			echo $x + "pizdets";
			
			$email = $_SESSION["email"];
			$conn = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
		
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			
			$sql4 = "SELECT * FROM Product where id = '".$x."'";
			
			$result4 = $conn->query($conn,$sql4);
		
			$pr = $result4["ProductTitle"];
			$Pc = $result4["Price"];
		
			$q2 = "insert into Cart (ProductName, price, email) values ('$pr', '$Pc', '$email')";
			 
		
			$r2 = $conn->query($q2);
			if ($r2 === true)
			{
				echo "product was addet to Cart";
				$conn->close();
				exit();
		
			}else { echo "shit happens here";}
			
		
	
		
?>	
