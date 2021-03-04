<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	
	if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['user_name']) || !is_numeric($_GET['user_name'])) {
		echo '<script>alert("Erro");</script>';
		echo 'A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$id_utilizador=$_GET['user_name'];
	$con=new mysqli("localhost", "root", "","dac");

	if($con->connect_errno!=0){
		echo "Erro<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from user_name where id = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $id_utilizador);
			$stm->execute();
			$res=$stm->get_result();
			$user_name = $res->fetch_assoc();
			$stm->close();
		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "A reencaminhar página";
			echo "<br>";
			header("refresh:5;url=index.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Detalhes</title>
</head>
<body>
	<h1>Detalhes do user_name</h1>
<?php
if (isset($user_name)) {
	echo"<br>";
	echo "<h4>User name: </h4>";
	echo utf8_encode( $user_name["user_name"]);
	echo "<hr>";
	echo "<br>";
	echo "<h4>nome: </h4>";
	echo utf8_encode( $user_name["nome"]);
	echo "<hr>";
	echo "<br>";
	echo "<h4>Email: </h4>";
	echo $user_name["email"];
	echo "<hr>";
	echo "<br>";
    echo "<h4>Password: </h4>";
	echo $user_name["password"];
	echo "<br>";
}
else{
	echo "<h1>Este utlizador não existe.<br>Confirme a sua seleção</h1>";
}
?>
</body>
</html>
<?php
}
else{
	echo 'Necessita  de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}


?>
