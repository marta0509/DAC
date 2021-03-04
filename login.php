<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Login</title>
</head>
<body style="background-color: #f7f7f7">
	<div class="container">
		<br><br><br><br><br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4" style="background-color: #ffffff; border: 1px solid rgba(147, 184, 189,0.8); border-radius: 19px">
	<h1 style="text-align: center; color: #405c60">Login</h1>

	<form method="post" action="processa_login.php">
	<p>
		<label>Nome do Utilizador</label>
<br>
		<input type="text" name="user_name" style="width: 100%; border-radius: 5px" required>
	</p>
	<p>
		<label>Palavra-passe</label>
		<br>
		<input type="text" name="password" style="width: 100%; border-radius: 5px" required>
	</p>
	<p>
	<input type="submit" name="login" style="width: 100%; background-color:#066a75; color: #ffffff; border-radius: 5px">
	</p>

			</div>
			<div class="col-md-4"></div>
			</div>
		</div>
	</form>
</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>