<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "crmNuvio/" . 'util/retornarJson.php';
$id = 1;

if(isset($_POST['idperfil'])){

	$id = $_POST['idperfil'];
}
else if(isset($_GET['idperfil'])){

	$id = $_GET['idperfil'];
}

$funcao = new RetornarJson(@$id);
$lista_pr = $funcao->retornarPerfilRotinas();
$lista_r = $funcao->retornarRotinas();


/** Encode nos resusltados e manda pro EXTjs **/ 

echo json_encode ( array (
		"success" => true,
		"data" => $lista_pr,
		"rotinas" => $lista_r
		
) );