function RegistrationForm(){

var warn="";
var rt=true;
var str_user_inputs = "";


//-- validate email --
var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 	
var uname_v = /^[a-zA-Z0-9_-]+$/;
var pswd_v = /^(\S*)?\d+(\S*)?$/;
var pattern_d = /^\d{1,2}\/\d{1,2}\/\d{4}$/;




//-- validate Username --
var y=document.forms.Registration.fname.value;/////////////////////////////////////////////////////////////////////
//-- add code here:
if (y==null || y==""){
    
    warn +="First Name is empty. \n";
    rt=false;
  
}
else if(y.length > 40){
	   warn += "Max length for First Name is 40 characters.\n"
	   rt =false;
	}
else if (uname_v.test(y) == false)
	{
	 warn += "Please enter the correct format for first name. (No leading or trailing spaces).\n"
	 rt =false;
	}

	else{ // if everything is okay, then collect Username
	   
	    str_user_inputs +="First rName: "+y+"\n";

	}

var l=document.forms.Registration.lname.value;////////////////////////////////////////////////////////////////////////////
//-- add code here:
if (l==null || l==""){
  
  warn +="Last Name is empty. \n";
  rt=false;

}
else if(l.length > 40){
	   warn += "Max length for Last Name is 40 characters.\n"
	   rt =false;
	}
else if (uname_v.test(l) == false)
{
 warn += "Please enter the correct format for last name. (No leading or trailing spaces).\n"
 rt =false;
}


	else{ // if everything is okay, then collect Username
	   
	    str_user_inputs +="UserName: "+l+"\n";

	}


var d=document.forms.Registration.date.value;///////////////////////////////////////////////////////////////
//-- add code
if (d==null || z==""){
  
  warn +="password is empty. \n";
  rt=false;

}
else if (pattern_d.test(d) == false)
{
 warn += "Invalid date of birth (dd-mm-yyyy)\n"
 rt =false;
}

	else{ 
	   
	    str_user_inputs +="Date of Birth: "+d+"\n";

	}

var x=document.forms.Registration.email.value; ////////////////////////////////////////////////////////////////////

if (x==null || x=="" ){
    
    warn +="Email is empty. \n";
    rt=false;
  
}
else if(x.length > 60){
   warn += "Max length for email is 60 characters.\n"
   rt =false;
}
else if (email_v.test(x) == false)
	{
	warn +="Email is incorect stile. \n";
    rt=false;
	}
else{ // if everything is okay, then collect email 
   
    str_user_inputs +="Email: "+x+"\n";

}


//-- validate password --
var z=document.forms.Registration.password.value;
//-- add code
if (z==null || z==""){
    
    warn +="password is empty. \n";
    rt=false;
  
}
else if(pswd_v.test(z) == false)
{
 warn += "Incorect password style\n"
 rt =false;
}
else if (z.length < 8){
	   warn += "length for password should be 8 or more characters.\n"
	   rt =false;
	}

	else{ 
	   
	    str_user_inputs +="password: "+z+"\n";

	}

//-- Confirm password --
var c=document.forms.Registration.Cpassword.value;
//-- add code

if (z != c)
{
	 warn += "confirmarion of passwords fail"
	 rt =false;

}
else{ 
	   
    str_user_inputs +="password: "+c+"\n";

}

if(rt==false){
  
  alert(warn);
  return false;

}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function login(){ 
	var warn="";
	var rt=true;
	var str_user_inputs = "";
	
	var x = document.forms.login.email.value;	
	var z = document.forms.login.password.value;
       
    var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 	
    
	var pswd_v = /^(\S*)?\d+(\S*)?$/;      

	if (x==null || x=="" ){
	    
	    warn +="Email is empty. \n";
	    rt=false;
	  
	}
	else if(x.length > 60){
	   warn += "Max length for email is 60 characters.\n"
	   rt =false;
	}
	else if (email_v.test(x) == false)
		{
		warn +="Email is incorect stile. \n";
	    rt=false;
		}
	else{ // if everything is okay, then collect email 
	   
	    str_user_inputs +="Email: "+x+"\n";

	}	
	if (z==null || z==""){
	    
	    warn +="password is empty. \n";
	    rt=false;
	  
	}
	else if(pswd_v.test(z) == false)
		{
		 warn += "Incorect style\n"
	     rt =false;
		}
	else if (z.length < 8){
		   warn += "length for password should be 8 or more characters.\n"
		   rt =false;
		}

		else{ 
		   
		    str_user_inputs +="password: "+z+"\n";

		}
     if(rt==false){
       
       alert(warn);
       return false;

     }
 
    															
}
function Vit() {	
	document.getElementById("Vit").innerHTML = "Category Vitamins has removed";
}
function Acid(){
	document.getElementById("Ac").innerHTML = "Category Acid reducer has removed";    
}
function eye(){
	document.getElementById("ey").innerHTML = "Category Eye care has removed";}
function pain(){
	document.getElementById("Pa").innerHTML = "Category Pain killers has removed";
}

function AddItem()
{
	
	var t, n, q, p, text;
	var name_v = /^[a-zA-Z0-9_-]+$/;
	t = document.getElementById("title12").value;
	c = document.getElementById("Categ").value;
	n = document.getElementById("dec").value;
	q = document.getElementById("quan").value;
	p = document.getElementById("price").value;
	
	if(name_v.test(t) == false)
		{
		text = "  Product Title (no leading or trailing spaces) or empty";
		document.getElementById("titl14").innerHTML = text;		
		}
	else
		{
		text = "good";
		document.getElementById("titl14").innerHTML = text;	
		}
	//////////////////////////////////////////////////////////////////////////////////////
		if(name_v.test(c) == false)
		{
		text = "   Category (no leading or trailing spaces) or empty";
		document.getElementById("Cat").innerHTML = text;		
		}
		else
		{
		text = "good";
		document.getElementById("Cat").innerHTML = text;	
		}
	///////////////////////////////////////////////////////////////////////////
	if(n.length < 150)
		{
		text = "  not long enought";
		document.getElementById("dec12").innerHTML = text;	
		}
	else if(n.length > 150)
	{
		text = "character counter:  " + n.length;
		document.getElementById("dec12").innerHTML = text;	
	}
	else if (n == "")
		{
		text = "  fill decription";
		document.getElementById("dec12").innerHTML = text;	
		}
	////////////////////////////////////////////////////////////////////////////////
	if(q == "" || q == null)
		{
		text = " fill quantity";
		document.getElementById("quan12").innerHTML = text;	
		}
	else if (q <= 0 || q > 99)
		{
		text = " Quantity available (canâ€™t be 0 or more than 99)";
		document.getElementById("quan12").innerHTML = text;	
		}
	else
	{
	text = "good";
	document.getElementById("quan12").innerHTML = text;	
	}///////////////////////////////////////////////////////////////////
	
	if (p == "" || p == null)
		{
		text = " fill price";
		document.getElementById("PR12").innerHTML = text;	
		}
	else
	{
	text = "good";
	document.getElementById("PR12").innerHTML = text;	
	}
}
function Remt()
{	href="#"
	alert("Item was removed!");	
}
//add event liteners just when is finished the document loading


function init() {
    bindInputs();
    let total;

    //if it is in the cart page, calculate the total
    if (total = document.getElementById("total")) {
        calcTotal();
    }
}

//here you will add all the addEventListeners for all inputs, so, you need first to check if it exist
function bindInputs() {
    let a, b, c, d, e, f, g, h;
  
    //for product quantity, first, get all inputs
    if (b = document.getElementsByClassName("quantity")) {
        //now, add the event for each input
        //need to convert the HTML Array none in Array
        Array.prototype.forEach.call(b, item => {
            item.addEventListener("change", checkQuantity);
        });
   }
 }
function checkQuantity(ev){
    let el = ev.currentTarget.value;
    if (el < 1 || el > 99){
        alert ("You have informed a incorrect amount");
        ev.currentTarget.value = 1;
    } else {
        calcTotal();href="#"
    }
}

function calcTotal() {
    let totalDiv = document.getElementById("total");
    let allPricesArray = document.getElementsByClassName("price");
    let q = document.getElementsByClassName("quantity");
    let allPrices = 0;

    //need to convert the HTML Array none in Array
    Array.prototype.forEach.call(allPricesArray, (item, i) => {
        allPrices += (parseFloat(item.innerText.replace("$", "")))*parseInt(q[i].value);
    });
    
    let gst = allPrices * 0.05;
    let pst = allPrices * 0.06;
    let shipping = 4.00;
    let total = allPrices+gst+pst+shipping;
    
    let html = "<table class=\"table table-striped table-sm\"><tbody><tr><td>Sub-Total</td><td>$"+allPrices.toFixed(2)+"</td></tr>";
    html += "<tr><td>GST</td><td>$"+gst.toFixed(2)+"</td></tr>";
    html += "<tr><td>PST SK</td><td>$"+pst.toFixed(2)+"</td></tr>";
    html += "<tr><td>Shipping</td><td>$"+shipping.toFixed(2)+"</td></tr>";
    html += "<tr><td>Total</td><td>$"+total.toFixed(2)+"</td></tr>";
    html += "</tbody></table>";
    
    totalDiv.innerHTML = html;
}
function AddCat()
{
	var NewCat = document.getElementById("Cat2").value;
	
	 $.ajax
	 ({
	  type:'post',
	  url:'Admin.php',
	  data:{
	   
	   New_Cat:NewCat;
	   
	  },
	  success:function(response) {
	   if(response=="success")
	   {
	    document.getElementById("cat").innerHTML=NewCat;
	    
	   }
	  }
	 });
}
function update() {
	  $("#notice_div").html('Loading..'); 
	  $.ajax({
	    type: 'GET',
	    url: 'HomePage.php',
	    timeout: 2000,
	    success: function(data) {
	      $("#nome").html(data);
	      $("#notice_div").html(''); 
	      window.setTimeout(update, 10000);
	    },
	    error: function (XMLHttpRequest, textStatus, errorThrown) {
	      $("#notice_div").html('Timeout contacting server..');
	      window.setTimeout(update, 60000);
	    }
	}