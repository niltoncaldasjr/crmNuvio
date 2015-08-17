<?php
/*-- Sessao --*/
session_start();

if( !$_POST['idempresa'] )
{
	$success = false;
	$msg = "Ocorreu uma falha na seleção de empresa";
	
}else{

	$_SESSION['empresa']['idempresa'] = $_POST['idempresa'];
	
	//var_dump($_SESSION['empresa']);
	
	$success = true;
	$msg = "[Sucesso]: Empresa selcionada com sucesso!";

}

echo json_encode(array(
		"success" => $success,
		"msg" => $msg
));
?>