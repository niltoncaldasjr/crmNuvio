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

$sql = "SELECT * FROM usuario WHERE usuario='$userName' and senha='$pass'"; // #9
$result = array (); // #10
if ($resultdb = mysqli_query( $con, $sql )) { // #11
	$count = $resultdb->num_rows; // #12
	if ($count == 1) {
		$_SESSION ['authenticated'] = "yes"; // #13
		$_SESSION ['username'] = $userName; // #14
		$result ['success'] = true; // #15
		$result ['msg'] = 'User authenticated!'; // #16
	} else {
		$result ['success'] = false; // #17
		$result ['msg'] = 'Incorrect user or password.'; // #18
	}
	$resultdb->close (); // #19
}
// $mysqli->close(); // #20
echo json_encode($result); // #21