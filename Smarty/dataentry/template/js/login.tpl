<html>
	<head>
		<title>Vending Machine Administration</title>
		
		<link rel="stylesheet" type="text/css" href="template/css/style.css"/>
		<script language="JavaScript" type="text/javascript" src="template/js/main.js"></script>
		</head>
	
	<body>
	
	<h2>Login</h2>
	<table>
	<form method="POST" action="{$self}">
	<input type="hidden" name="login" value="1">
	<tr><td>Username</td><td><input type="text" name="username"></td></tr>
	<tr><td>Password</td><td><input type="password" name="password"></td></tr>
	<tr><td colspan="2"><input type="submit" value="Login"></td></tr>
	</form>
	</table>

	</body>
</html>