<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cart</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />
</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page    </a>  <a href="Profile.php"> Profile</a>
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
<div class="shopping-cart">
  <!-- Title -->
  <div class="title">
    Shopping Cart
  </div>
 
  <!-- Product #1 -->
  <div class="item">
    <div class="buttons">
      <button onclick="Remt()"> Remove </button>   
    </div>
 
    <div class="image">
      <img src="CenCar.jpg" alt="" style = "display:inline" width = "50" height = "50" />
    </div>
 
    <div class="description">
      <span>Centrum</span>
      <span>Vitamins</span>
      <span>For heart</span>
      
    </div>
 
    <div class="quantity1">
      
      <input onclick ="bindInputs()" type="number" required="" min="1" max="99" class="form-control mr-sm-2 quantity" value="1" placeholder="Informe the quantity"/>
       <span class="text-muted price">$19</span>
    </div>
 
   
  </div>
 
  <!-- Product #2 -->
  <div class="item">
    <div class="buttons">
      <button onclick="Remt()"> Remove </button>   
    </div>
 
    <div class="image">
      <img src="CenMuMen.jpg" alt=""style = "display:inline" width = "30" height = "50"/>
    </div>
 
    <div class="description">
      <span>Centrum</span>
      <span>Vitamins</span>
      <span>for man</span>
    </div>
 
    <div class="quantity1">
      <input onclick ="bindInputs()" type="number" required="" min="1" max="99" class="form-control mr-sm-2 quantity" value="1" placeholder="Informe the quantity"/>
      <span class="text-muted price">$20</span>
    </div>
 
    
  </div>
 
  <!-- Product #3 -->
  <div class="item">
    <div class="buttons">
      <button onclick="Remt()"> Remove </button>     
    </div>
 
    <div class="image">
      <img src="CenMuWo.jpg" alt=""  style = "display:inline" width = "50" height = "50"/>
    </div>
 
    <div class="description">
      <span>Centrum</span>
      <span>Vitamins</span>
      <span>For Women</span>
    </div>
 
    <div class="quantity1">
     <input onclick ="bindInputs()" type="number" required="" min="1" max="99" class="form-control mr-sm-2 quantity" value="1" placeholder="Informe the quantity"/>
     <span class="text-muted price">$20</span>
    </div>
 
    
      </div>   
  
</div>
 <div class="col-12 col-sm-3 table-responsive" id="total"></div>



<footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>

<footer> © Nature In a Pocket 2018 </footer>
</body>
<script type = "text/javascript"  src = "validation.js" ></script>
<script>document.body.addEventListener("load", init(), false);</script> 
        
</html>