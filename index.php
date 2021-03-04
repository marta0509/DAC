<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo


 ?>



<!DOCTYPE html>
<html>
<head>
	<title></title>

<?php  
include('boots.php');
?>
</head>
<body>




<?php 
include('nav.php');
//session_start();
$con=new mysqli("localhost","root","","dac");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
	exit;
}
else{
	if(!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
	if($_SESSION['login']=="correto"){



	 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Produtos</title>
</head>
<body>





<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h1>Lista de Produtos <i class="fas fa-edit"></i></h1>
<?php 
$stm=$con->prepare('select * from produtos');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

 	echo '<a href="produtos_show.php?produtos='.$resultado['id_produto'].'">';
	echo "<h5>".$resultado['produtos']."</h5>";
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="produtos_edit.php?produtos='.$resultado['id_produto'].'"><button style="background: #069cc2; border-radius: 6px; padding: 6px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Editar</button></a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="produtos_delete.php?produtos='.$resultado['id_produto'].'"<button style="background: #069cc2; border-radius: 6px; padding: 6px; cursor: pointer; color: #fff; border: none; font-size: 16px;">eliminar</button></a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>
		<div class="col-md-4">
<h1>Utilizadores <i class="fas fa-book"></i></h1>
<?php 
$stm=$con->prepare('select * from utilizadores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="utilizadores_show.php?utilizador='.$resultado['id_utilizador'].'">';
	echo "<h5>".$resultado['numero']."</h5>";
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="utilizadores_edit.php?utilizador='.$resultado['id_utilizador'].'"><button style="background: #069cc2; border-radius: 6px; padding: 6px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Editar</button></a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="utilizadores_delete.php?utilizador='.$resultado['id_utilizador'].'"><button style="background: #069cc2; border-radius: 6px; padding: 6px; cursor: pointer; color: #fff; border: none; font-size: 16px;">eliminar</button></a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>







		<hr>
	
		<div class="col-md-4">
<h1>Links <i class="fas fa-link"></i></h1>
<br>
<a href="produtos_create.php"><button> Adicionar Produtos</button></a>
<br>
<a href="utilizadores_create.php"><button>Adicionar Utilizadores</button></a>
<br>
<a href="login.php"><button>logout</button></a>
	
		</div>
	
	</div>
</div>



<?php 
} //end if 
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}

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