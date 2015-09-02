<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

$link = Conexao::getInstance()->getConexao();
$jsonData =  $_POST['data'];

$data = json_decode($jsonData);

$id 		= $data->id;
$idperfil 	= $data->idperfil;
$idrotina 	= $data->id;

if($data->consulta == true){
	$data->consulta = 0;
}else if($data->consulta == false){
	$data->consulta = 1;
}

if($data->incluir == true){
	$data->incluir = 0;
	
}else if($data->incluir == false){
	$data->incluir = 1;
}

if($data->alterar == true){
	$data->alterar = 0;
}else if($data->alterar == false){
	$data->alterar = 1;
}

if($data->excluir == true){
	$data->excluir = 0;
}else if($data->excluir == false){
	$data->excluir = 1;
}

$query = sprintf("UPDATE perfilrotina SET consulta = %d, incluir = %d, alterar = %d, excluir = %d WHERE id = %d",
		mysqli_real_escape_string($link, $data->consulta),
		mysqli_real_escape_string($link, $data->incluir),
		mysqli_real_escape_string($link, $data->alterar),
		mysqli_real_escape_string($link, $data->excluir),
		mysqli_real_escape_string($link, $data->id));
		
$result = mysqli_query($link, $query);
if(!$result){
	die('[ERRO]: '.mysqli_error($link));
}else {
	echo json_encode(array(
			"success" => 0
	));
}