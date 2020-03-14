<html>
	<head>
		<title>Vending Machine Administration</title>
		
		<link rel="stylesheet" type="text/css" href="template/css/style.css"/>
		{$xajaxJavaScript}
		<script language="JavaScript" type="text/javascript" src="template/js/main.js"></script>
		
	</head>
	
	<body>
	
	<div id="mainPage">
	<h2>Login</h2>
	<form method="POST" action="{$self}">
	<input type="hidden" name="login" value="1">
	<table>
	<tr><td>Username</td><td><input type="text" 
name="username"></td></tr>
	<tr><td>Password</td><td><input type="password" 
name="password"></td></tr>
	<tr><td colspan="2"><input type="submit" 
value="Login"></td></tr>
</table>
	</form>
	</div>
	</body>
</html>
