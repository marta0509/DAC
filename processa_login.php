<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=="POST"){

		if(isset($_POST['user_name']) && isset($_POST['password'])){

			$utilizador=$_POST['user_name'];
			$password=$_POST['password'];

			$con=new mysqli("localhost","root","","dac");


			if($con->connect_errno!=0){
				echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
				exit;
			}
			else{
				$sql="Select * from utilizadores where user_name=? AND password=?";
				$stm=$con->prepare($sql);
				if ($stm!=false) {
					$stm->bind_param("ss",$utilizador,$password);
					$stm->execute();
					$res=$stm->get_result();

					if($res->num_rows==1){
						$_SESSION['login']='correto';
						header("refresh:1;url=index.php");
					}
					else{
						$_SESSION['login']='incorreto';
						header("refresh:1;url=login.php");
					}
					
					
				}
				else{
					echo "Ocorreu um erro no acesso á base de dados. <br> STM:".$con->connect_error;
					exit;
				}
			}
		}
	}
?>