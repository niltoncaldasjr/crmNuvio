<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "crmNuvio/" . 'util/retornarJson.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilRotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/perfilrotina/PerfilRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/perfil/Perfil.php';
/*-- Sessao --*/
session_start();

$data =  json_decode( $_POST['data'] );
$metodo = $_GET['metodo'];


switch($metodo)
{
	case "post": {		
		SalvaPerfilRotina($data);
		break;
	}
	case "delete": {
		DeletaPerfilRotina($data);
		break;
	}
}

/*-- Metodo de cadastro da EmpresaUsuario --*/
function SalvaPerfilRotina($data){
	// echo "Vamos cadastrar";
	foreach ($data as $key) {
		$objRotina = new Rotina();
		$objPerfil = new Perfil();
		$objPerfilRotina = new PerfilRotina();

		$objRotina->setId($key->idrotina);
		$objPerfil->setId($key->idperfil);
		$objPerfilRotina->setObjRotina($objRotina);
		$objPerfilRotina->setObjPerfil($objPerfil);

		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);

		$id = $objPerfilRotinaControl->cadastrar();
		$objPerfilRotina->setId($id);
	}
	
	$funcao = new RetornarJson($objPerfil->getId());
	$lista_pr = $funcao->retornarPerfilRotinas();
	$lista_r = $funcao->retornarRotinas();
	
	echo json_encode ( array (
			"success" => true,
			"data" => $lista_pr,
			"rotinas" => $lista_r
				
	) );
}

/*-- Metodos de delete da EmpresaUsuario --*/
function DeletaPerfilRotina($data){
	// echo "Vamos deletar";
	foreach ($data as $key) {
		$objRotina = new Rotina();
		$objPerfil = new Perfil();
		$objPerfilRotina = new PerfilRotina();

		$objRotina->setId($key->idrotina);
		$objPerfil->setId($key->idperfil);
		$objPerfilRotina->setObjRotina($objRotina);
		$objPerfilRotina->setObjPerfil($objPerfil);

		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);

		$objPerfilRotinaControl->deletarPorPerfilRotina();

	}
		
}


?>