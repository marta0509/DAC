<?php  
//include('boots.php');Bootstrap link
?>
<?php 

//session_start();
//if (!isset($_SESSION['login'])) {
	//$_SESSION['login']="incorreto";
//}
////if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$nome="";
	$categoria_tipologia="";
	$funcao="";
	$especializacao="";
	$legislacao="";
	$imagem="";
	if (isset($_POST['nome'])) {
		$disciplina=$_POST['nome'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do Nome do produto.');</script>";
	}
	if (isset($_POST['categoria_tipologia'])) {
		$categoria_tipologia=$_POST['categoria_tipologia'];
	}
	if (isset($_POST['funcao'])) {
		$funcao=$_POST['funcao'];
	}
	if (isset($_POST['especializacao'])) {
		$especializacao=$_POST['especializacao'];
	}
	if (isset($_POST['legislacao'])) {
		$legislacao=$_POST['legislacao'];
	}
	if (isset($_POST['imagem'])) {
		$imagem=$_POST['imagem'];
	}
	
	$con=new mysqli("localhost","root","","dac");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='insert into produtos (nome, categoria_tipologia, funcao, especializacao, legislacao, imagem ) values (?,?,?,?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('ssssss',$nome,$categoria_tipologia,$funcao,$especializacao,$legislacao,$imagem);
			$stm->execute();
			$stm->close();

			echo "<script>alert('Produto adicionado com sucesso')</script>";

			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:5; url=index.php");
		} 
	} //end if
} //if
else{
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Adicionar Produtos</title>
</head>
<body>
<h1>Adicionar Produtos</h1>
<form action="produto_create.php" method="post">
	<label>Nome</label><input type="text" name="nome" required><br>
	<label>Categorias tipo logia</label><input type="text" name="categoria_tipologia"><br>
	<label>Função</label><input type="text" name="funcao"><br>
	<label>Especialização</label><input type="text" name="especializacao"><br>
	<label>Legislação</label><input type="text" name="legislacao"><br>
	<label>Imagem</label><input type="file" name="imagem"><br>
	<input type="submit" name="enviar">
</form>
<a href="index.php">Menu</a>
</body>
</html>
<?php  
}

//}
//else{
//	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
//	header('refresh:2;url=login.php');
//}


?>