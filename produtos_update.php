<?php

if($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$idProduto="";
	$categoria_tipologia="";
	$funcao="";
	$especializacao="";
	$legislacao="";

	if(isset($_POST['nome'])) {
		$nome= $_POST['nome'];
	}
	else {
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if(isset($_POST['id_produto'])) {
		$idProduto= $_POST['id_produto'];
	}
	if(isset($_POST['categoria_tipologia'])){
		$categoria_tipologia = $_POST['categoria_tipologia'];
	}

	if (isset($_POST['funcao'])) {
		$funcao = $_POST['funcao'];
	}

	if(isset($_POST['especializacao'])) {
		$especializacao= $_POST['especializacao'];
	}

	if(isset($_POST['legislacao'])) {
		$legislacao= $_POST['legislacao'];
	}

	$con = new mysqli("localhost","root","","dac");

	if($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
		exit();
	}
	else {
		$sql = "update produtos set nome=?,categoria_tipologia=?,funcao=?,especializacao=?,legislacao=? where id_produto=?";
		$stm = $con->prepare ($sql);

		if ($stm!=false) {
			$stm->bind_param("ssisss", $nome, $categoria_tipologia, $idProduto, $funcao, $especializacao, $legislacao);
			$stm->execute();
			echo'<script>alert("Produto atualizado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:2;url=index.php");
		}
	}
	}

