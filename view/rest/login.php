<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

$con = Conexao::getInstance()->getConexao();

$userName = $_POST ['user']; 
$pass = $_POST ['password']; 

$userName = stripslashes ( $userName ); 
$pass = stripslashes ( $pass ); 

$userName = mysqli_real_escape_string( $con, $userName ); 
$pass = mysqli_real_escape_string ( $con ,$pass ); 

$sql = "SELECT * FROM usuario WHERE usuario='$userName' and senha='$pass'"; 
$result = array (); 
if ($resultdb = mysqli_query( $con, $sql )) { 
	
	$count = $resultdb->num_rows; 
	if ($count == 1) {
		if ($row = mysqli_fetch_assoc($resultdb)){
			$_SESSION['usuario']=array('idusuario'=>$row['id'],'usuario'=>$row['usuario']);			
		}	
		
		$_SESSION ['authenticated'] = "yes"; 		
		$_SESSION ['username'] = $userName; 

		$result ['success'] = true; 
		$result ['msg'] = 'User authenticated!'; 
	} else {
		$result ['success'] = false; 
		$result ['msg'] = 'Incorrect user or password.'; 
	}	
	$resultdb->close (); 
}
echo json_encode($result); 