<html>
<title>Sign Up</title>
<head>
<script src="js/myjs.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   
    <script src="js/script.js"></script>    
	<link rel="stylesheet" href="css/css.css" style="text/css"/>
	
	<script>
function validateForm()
{
var x=document.getElementById("email").value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}
</script>
</head>
<body>

<div style="position:absolute;top:15%;left:25%;">
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	 <form name="signup_form" id="signup_form" action="getSignUpData.php" onsubmit="return validateForm();" method="post">	
	 <h4 class="text_style1">New user Registration</h4>
		<tr>
		<td >First Name:</td>
		<td><input type="text" name="FirstName" id="FirstName" class="textBox" autofocus required></td>
		
		</tr>
		<tr>
		<td >Last Name:</td>
		<td ><input type="text" name="LastName" id="LastName" class="textBox" ></td>
	
		</tr>		
		<tr>
		<td>Username:</td>
		<td ><input type="text" name="uname" id="uname" class="textBox"  required></td>
		
		</tr>
		<tr>
		<td>Password:</td>
		<td ><input type="password" name="pwd" class="textBox" id="pwd" required></td>
		
		</tr>
		<tr>
		<td >Email:</td>
		<td ><input type="text" name="email" id="email" class="textBox" required></td>
		
		</tr>
		<tr>
		<td >Gender:</td>
		<td>Male <input type="radio" name="gender" id="gender" value="Male" id="gender"  >
		Female <input type="radio" name="gender" id="gender2" value="Female" ></td>
		
		</tr>
		<tr>
		<td >DOB:(m/d/Y)</td>
		<td id="DOB_txt"><input type="text" id="datepicker" name="DOB" class="textBox"  required></td>
		
		</tr>
		<tr> <td></td>
		
		<td colspan="2" id="save"><input type="submit" id="btn" value="Sign Up" ></td>
      </form>
	 </table>
	
</div>

</body>
</html>