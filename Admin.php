<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<?php
$host="localhost";
$username="andriiev";
$password="2006vA3";
$databasename="andriiev";
$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

$select =mysql_query("SELECT Category FROM Categories");
?>
<meta charset="UTF-8">
<title>Admin</title>
<link rel="stylesheet" href="MyStyleA.css" type="text/css" />


</head>
<body>
<header class="login">
<a href="HomePage.php"> Home Page</a> <a href="Logout.php"> Logout</a>
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
<a class="product" href="Product.php"> Product list</a>
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



<p><b>Add/delete categorie</b></p>

<!-- Trigger/Open The Modal -->

<button id="myBtn" type="button">Add/Delete</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="vertical-menu">
		  <a href="#" class="active">Category</a>
	<?php
while ($row=mysql_fetch_array($select)) 
{
 ?><?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
 <a id="cat"><?php echo $row["Category"];?></a>
  <?php
}
?>
		  <form  action="Admin.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="submitted2" value="1"/>
		  <table>
		 <tr><td>New Category: </td><td> <input type="text" id="Cat2" name="Categ2" size="30" /><button id="AmyBtn" onclick = "AddCat()">Add Category</button></td></tr>
		  <tr><td>Remove Category: </td><td> <input type="text" id="Cat3" name="Categ3" size="30" /><button id="AmyBtn">Delete</button></td></tr>
		  </table>
		  </form>
</div>
  </div>

</div>



<h3>Add/Remove Product</h3>

<!-- Trigger/Open The Modal -->
<button type = "button" id="myBtn2">Add/Remove</button>

<!-- The Modal -->
<div id="myModal2" class="modal2">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close2">&times;</span>    	
<form id="AddItem" onsubmit ="return AddItem()" action="Admin.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="submitted" value="1"/>
<table>
	<tr><td>Product title: </td><td> <input id="title12" name = "Title" size="30" /><p id ="titl14"></p></td></tr>
	
	<tr><td>Category: </td><td> <input id="Categ" name = "Category" size="30" /><p id ="Cat"></p></td></tr>
			
	<tr><td>Description: </td><td> <input id="dec" name = "Dec"  size="30" /><p id ="dec12"></p></td></tr>
	
 	<tr><td>Quantity available: </td><td> <input id="quan" name = "Quan"  size="30" /><p id ="quan12"></p></td></tr> 	
 	
 	<tr><td>Price: </td><td> <input id="price" name = "Price"  size="30" /><p id ="PR12"></p></td></tr>      
 	
    <tr><td>Picture: </td><td> <input type="file" name="image" accept="image/*"></td></tr>
</table>
 
<button id="myBtn3" type="submit" onclick="AddItem()">Submit</button>
<input type="reset" name="Reset" value="Reset" />
</form>
  </div>
  </div>
<h5 align="center"><font size="+20"><b> Costumers have did those purchases:</b></font></h5>

<h5><font size="+20"><b> Add quontity</b></font></h5>
<form  action="Admin.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="submitted3" value="1"/>
		  <table>
		  <tr><td>Product title: </td><td> <input id="title123" name = "Title2" size="30" /></td></tr>
		 <tr><td>Add quontity: </td><td> <input  id="quan2" name="Quan2" size="30" /></td></tr>
		  <tr><td><button id="SmyBtn">Save</button></td></tr>
		  </table>
		  </form>
	<p></p>	  
		  
		  
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
 <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "Watch the page reload itself in 10 second!";
    ?>
    </body>
     <footer>
		Validate <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Furegina.ca%2F~martinsp%2F" class = "ordinaryLink">HTML5</a>
	</footer>
<footer> © Nature In a Pocket 2018 </footer>
<script type="text/javascript" src="validation.js"></script>


<script>
var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");

//Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btn2 = document.getElementById("myBtn2");


//Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close2")[0];
//When the user clicks the button, open the modal 
btn.onclick = function() {
 modal.style.display = "block";
}
btn2.onclick = function() {
 modal2.style.display = "block";
}
//When the user clicks on <span> (x), close the modal
span.onclick = function() {
 modal.style.display = "none";
}

span2.onclick = function() {
 modal2.style.display = "none";
}

//When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
 if (event.target == modal) {
     modal.style.display = "none";
 }
}
 window.onclick = function(event) {
	 if (event.target == modal2) {
	     modal2.style.display = "none";
	 }
 }
</script>
<script type="text/javascript">document.getElementById("myBtn3").addEventListener("click", AddItem);</script>
</body>
</html>


		
	
<?php

$validate = true;
$validate2 = true;
$validate3 = true;
$validate4 = true;
if (isset($_POST["submitted"]) && $_POST["submitted"])
{
   
    $Product = trim($_POST["Title"]);
    $Category = trim($_POST["Category"]);
    $Desc = trim($_POST["Dec"]);
    $Quant = trim($_POST["Quan"]);
    $Pric = trim($_POST["Price"]);    
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));
    
      
       
    $db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
        echo "Connection failed";
    }
    
    $q1 = "SELECT * FROM Product WHERE ProductTitle = '$Product'";
    $r1 = $db->query($q1);

    // if the email address is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
        
    }
    else
    {
    	
    	if($Product == null || $Product == "")
    	{
    		$validate = false;
    		
    	}
    	if($Category == null || $Category == "")
    	{
    		$validate = false;
    	
    	}
    	
    	if($Desc== null || $Desc == "")
    	{
    		$validate = false;
    		
    	}
    	
     
        if($Quant == null || $Quant == "")
        {
            $validate = false;
           
        }
        
        if($Pric == null || $Pric == "")
        {
        	$validate = false;
        	
        } 
    }

    if($validate == true)
    {
    	
    	
        //add code here to insert a record into the table User;
        // table User attributes are: email, password, DOB
        // variables in the form are: email, password, dateFormat, 
        $q2 = "insert into Product (ProductTitle, Category, Description, Quontity, Price, image) values ('$Product', '$Category', '$Desc', '$Quant','$Pric','$imgContent')";
      

        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
        	$error = "Product has added";
        	echo "<script type='text/javascript'>alert('$error');</script>";
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

  
    if (isset($_POST["submitted3"]) && $_POST["submitted3"])
    {
    	$Pro = trim($_POST["Title2"]);
    	$Qua = trim($_POST["Quan2"]);
    
    	$db3 = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    
    	if ($db3->connect_error)
    	{
    		die ("Connection failed: " . $db3->connect_error);
    		echo "Connection failed";
    	}
    
    	$q3 = "UPDATE Product SET Quontity = '$Qua' WHERE ProductTitle = '$Pro'";
    	$r3 = $db3->query($q3);
    	if($r3->num_rows > 0)
    	{
    		$validate3 = false;
    
    	} else
    	{
    		 
    		if($Qua == null || $Qua == "")
    		{
    			$validate3 = false;
    
    		}
    	}
    	if($validate3 == true)  
    	 	{
    		 
    		 
    		
    		 
    		if ($r3 === true)
    		{
    			$error = "Quontity has added";
    			echo "<script type='text/javascript'>alert('$error');</script>";
    			$db2->close();
    			exit();
    
    		}else { echo "shit happens here";}
    		}
    
    		}
    
    		if (isset($_POST["submitted2"]) && $_POST["submitted2"])
    		{
    			$Cata = trim($_POST["Categ2"]);
    			$Cata2 = trim($_POST["Categ3"]);
    		
    			$db2 = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    		
    			if ($db2->connect_error)
    			{
    				die ("Connection failed: " . $db2->connect_error);
    				echo "Connection failed";
    			}
    		
    			$q3 = "SELECT * FROM Categories WHERE Category = '$Cata'";
    			$r3 = $db2->query($q3);
    			if($r3->num_rows > 0)
    			{
    				$validate2 = false;
    		
    			} else
    			{
    				 
    				if($Cata == null || $Cata == "")
    				{
    					$validate2 = false;
    		
    				}
    			}
    			if($validate2 == true)
    			{
    				 
    				 
    				//add code here to insert a record into the table User;
    				// table User attributes are: email, password, DOB
    				// variables in the form are: email, password, dateFormat,
    				$q4 = "insert into Categories (Category) values ('$Cata')";
    				 
    				 
    				$r4 = $db2->query($q4);
    				 
    				if ($r4 === true)
    				{
    					$error = "Category has added";
    					echo "<script type='text/javascript'>alert('$error');</script>";
    						
    		
    				}else { echo "shit happens here";}
    		}
    		
    		
    		    		if($Cata2 == null || $Cata2 == "")
    		    		{
    		    		$validate4 = false;
    		
    		    		}
    		    		else {
    		    		$q5 = "delete from Categories where Category ='$Cata2'";
    		
    		
    		    		$r5 = $db2->query($q5);
    		
    		    		if ($r5 === true)
    		    		{
    		    		$error = "Category has Removed";
	echo "<script type='text/javascript'>alert('$error');</script>";
    			echo "<script> refresh(); </script>";
    		
}else { echo "shit happens here";}
    		
$db2->close();
    		exit();
    		    		}
    		    		}
 ?>   