<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['produtos']) && is_numeric($_GET['produtos'])) {
		$idProduto = $_GET['produtos'];
		$con = new mysqli ("localhost","root","","dac");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso à base de dados. <br>" .$con->conect_error. "</h1>";
			exit();
		}
		$sql = "Select * from produtos where id=?";
		$stm = $con->prepare($sql);
		if($stm!=false) {
			$stm->bind_param("i",$idProduto);
			$stm->execute();
			$res=$stm->get_result();
			$cidades = $res->fetch_assoc();
			$stm->close();
		}
?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Editar produto</title>
		</head>
		<body>
		<h1>Editar produto</h1>
		<form action="produtos_update.php" method="post">
			<label>ID Produto</label><input type="text" name="id" required value ="<?php echo$produtos['id_produto'];?>"><br> // nao tenho a certeza se é id ou id_produto
			<label>Nome</label><input type="text" name="pais" required value ="<?php echo$produtos['nome'];?>"><br>
			<input type="submit" name="enviar"><br>
		</form>
		</body>
		</html>
		<?php
	}
	else {
		echo ('<h1>Houve um erro ao processar o pedido. <br> Dentro de segundos será reencaminhado!</h1>');
		header("refresh=5;url=index.php");
		
	}
}