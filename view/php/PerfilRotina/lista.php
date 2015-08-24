<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

/*-- Sessao --*/
session_start();

$mysqli = Conexao::getInstance()->getConexao();
	
$id = $_POST['idperfil'];

$queryString = "SELECT e.* FROM perfil u ";
$queryString .= "INNER JOIN perfilrotina eu ON u.id = eu.idperfil ";
$queryString .= "INNER JOIN rotina e ON eu.idrotina = e.id ";
$queryString .= "WHERE u.id = '$id' ";

// var_dump($queryString);
$empresas	= array();
$empresas2 	= array();

if($resultdb = $mysqli->query($queryString)){
	
	$empresaUsuario = "(";
	while($user = $resultdb->fetch_assoc()){
		$empresas[] = $user;
		$empresaUsuario .= $user['id'] . ",";
		
	}

	$empresaUsuario = substr($empresaUsuario, 0, -1) . ")";
	
	if($empresaUsuario == ")"){$empresaUsuario = "( 0 )";}

	$query = "SELECT * FROM rotina WHERE id NOT IN $empresaUsuario";

	// echo $query;
	
	if($resultdb = $mysqli->query($query)){
		
		while($empresa = $resultdb->fetch_assoc()){
			$empresas2[] = $empresa;
		}
		
	}

	$success = 'true';
	$msg = 'Sucesso';
	
	/*-- Encodamos para o json --*/
}else{
	$success = 'false';
	$msg = 'Nenhum dado encontrado';
}
echo json_encode(array(
		"success" => $success,
		"data" => $empresas,
		"data2" => $empresas2,
		"msg" => $msg
));
?>