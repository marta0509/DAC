<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo

 ?>



<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['produtos'])|| !is_numeric($_GET['produtos'])) {
		echo "<script>alert('Erro ao abrir produto');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idAula=$_GET['produtos'];
	$con=new mysqli("localhost","root","","dac");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from produtos where id= ?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idProdutos);
			$stm->execute();
			$res=$stm->get_result();
			$aula=$res->fetch_assoc();
			$stm->close();

		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar pagina";
			echo "<br>";
			header("refresh:5; url=index.php");
		}
	}//end if 
}//if($_server...)
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detalhes</title>
</head>
<body>
<h1>Detalhes dos produtos</h1>
<?php 
if (isset($produtos)) {
	echo "<br>";
	echo utf8_encode($produtos['id_produto']);
	echo "<br>";
	echo utf8_encode($produtos['nome']);
	echo "<br>";
	echo utf8_encode($produtos['categoria_tipologia']);
	echo "<br>";
	echo utf8_encode($produtos['funcao']);
	echo "<br>";
	echo utf8_encode($produtos['especializacao']);
	echo "<br>";
	echo utf8_encode($produtos['legislacao']);
	echo "<br>";
	echo utf8_encode($produtos['imagem']);

}
else{
 echo "<h2>Parece que a aula selecionado nao existe. <br> confirme a sua seleção</h2>";
}

?>

</body>
</html>



<?php
}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
  ?>