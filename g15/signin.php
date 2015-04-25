<html>
<title>Sign In</title>
<?php
session_start();
?>
<head>
<link rel="stylesheet" href="css/css.css" type="text/css" />
</head>
<body>

<div style="margin-top:7%;">
<p style="margin-left:39%;">Enter your Username and Password</p>
  <table align="center" cellpadding="6" cellspacing="8" border="0">
	  <form name="signin_form" id="signin_form" action="getSignInData.php" method="post">	
		<tr>
		<td >Username:</td>
		<td><input type="text" name="uname" id="uname" class="textBox" placeholder="Username" autofocus required ></td>
		</tr>
		<tr>
		<td>Password:</td>
		<td><input type="password" name="pwd" class="textBox" id="pwd" placeholder="Password" required></td>
		</tr>
		<tr>
		<td></td>
		<td colspan="2"><input type="submit" id="btn" value="Sign In"> </td></tr>
      </form>
	 </table>
</div>
</body>
</html>
