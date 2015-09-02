<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

$link = Conexao::getInstance()->getConexao();
$jsonData =  $_POST['data'];

$data = json_decode($jsonData);

$idperfil = $data->idperfil;
$idrotina = $data->id;

$query = sprintf("SELECT * FROM perfilrotina WHERE idperfil = $idperfil");

$result = mysqli_query($link, $query);
if(!$result){
	die('[ERRO]: '.mysqli_error($link));
}
while ($row = mysqli_fetch_assoc($result)){
	if($row['consulta'] == 0){
		$row['consulta'] = true;
	}else if($row['consulta'] == 1){
		$row['consulta'] = false;
	}
	
	if($row['incluir'] == 0){
		$row['incluir'] = true;
	}else if($row['incluir'] == 1){
	$row['incluir'] = false;
	}
	
	if($row['alterar'] == 0){
		$row['alterar'] = true;
	}else if($row['alterar'] == 1){
		$row['alterar'] = false;
	}
	
	if($row['excluir'] == 0){
		$row['excluir'] = true;
	}else if($row['excluir'] == 1){
		$row['excluir'] = false;
	}
	
	$lista[] = $row;
	
}


// $jsonData =  $_POST['data'];

// $data = json_decode($jsonData);

// $idperfil = $data->param;
// $idrotina = $data->id;

// if($data->consulta == true){
// 	$consulta = 0;
// }else if($data->consulta == false){
// 	$consulta = 1;
// }

// if($data->incluir == true){
// 	$incluir = 0;
// }else if($data->incluir == false){
// 	$incluir = 1;
// }

// if($data->alterar == true){
// 	$alterar = 0;
// }else if($data->alterar == false){
// 	$alterar = 1;
// }

// if($data->excluir == true){
// 	$excluir = 0;
// }else if($data->excluir == false){
// 	$excluir = 1;
// }


// $query = sprintf("UPDATE perfilrotina SET consulta = '%s', incluir = '%s', alterar = '%s', excluir = '%s' WHERE idperfil = %d AND idrotina = %d",
// 		mysqli_real_escape_string($link, $consulta),
// 		mysqli_real_escape_string($link, $incluir),
// 		mysqli_real_escape_string($link, $alterar),
// 		mysqli_real_escape_string($link, $excluir),
// 		mysqli_real_escape_string($link, $idperfil),
// 		mysqli_real_escape_string($link, $idrotina));
		
// $result = mysqli_query($link, $query);
// if(!$result){
// 	die('[ERRO]: '.mysqli_error($link));
// }	
echo json_encode(array(
		"success" => 0,
		"data" => $lista
));