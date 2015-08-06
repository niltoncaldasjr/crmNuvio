<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

/*-- Sessao --*/
session_start();

$mysqli = Conexao::getInstance()->getConexao();

$id = 1;//$_SESSION['usuario']['id'];


//- PR-> 	PerfilRotina
//- U-> 	Usu�rio
//- R-> 	Rotina

//SELECT e.nomeFantasia FROM usuario u INNER JOIN empresausuario eu ON u.id = eu.idusuario INNER JOIN empresa e ON eu.idempresa = e.id

$queryString = "SELECT e.* FROM usuario u ";
$queryString .= "INNER JOIN empresausuario eu ON u.id = eu.idusuario ";
$queryString .= "INNER JOIN empresa e ON eu.idempresa = e.id ";
$queryString .= "WHERE u.id = '$id' ";

//var_dump($queryString);
$empresas = array();
				

if($resultdb = $mysqli->query($queryString)){
	

	while($user = $resultdb->fetch_assoc()){
		$empresas[] = $user;
		
	}
	
	//$empresas[] = $dados;
				
	//var_dump($dados);
	//$resultdb->close();

	//mysql_close();

	/*-- Encodamos para o json --*/
	echo json_encode(array("items" => $empresas));
}
?>