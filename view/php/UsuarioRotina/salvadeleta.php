<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioRotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/usuariorotina/UsuarioRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/usuario/Usuario.php';
/*-- Sessao --*/
session_start();

$data =  json_decode( $_POST['data'] );
$metodo = $_GET['metodo'];


switch($metodo)
{
	case "post": {
		SalvaUsuarioRotina($data);
		break;
	}
	case "delete": {
		DeletaUsuarioRotina($data);
		break;
	}
}

/*-- Metodo de cadastro da EmpresaUsuario --*/
function SalvaUsuarioRotina($data){
	// echo "Vamos cadastrar";
	foreach ($data as $key) {
		$objRotina = new Rotina();
		$objUsuario = new Usuario();
		$objUsuarioRotina = new UsuarioRotina();

		$objRotina->setId($key->idrotina);
		$objUsuario->setId($key->idusuario);
		$objUsuarioRotina->setObjRotina($objRotina);
		$objUsuarioRotina->setObjUsuario($objUsuario);

		$objUsuarioRotinaControl = new UsuarioRotinaControl($objUsuarioRotina);

		$objUsuarioRotinaControl->cadastrar();

	}
}

/*-- Metodos de delete da EmpresaUsuario --*/
function DeletaUsuarioRotina($data){
	// echo "Vamos deletar";
	foreach ($data as $key) {
		$objRotina = new Rotina();
		$objUsuario = new Usuario();
		$objUsuarioRotina = new UsuarioRotina();

		$objRotina->setId($key->idrotina);
		$objUsuario->setId($key->idusuario);
		$objUsuarioRotina->setObjRotina($objRotina);
		$objUsuarioRotina->setObjUsuario($objUsuario);

		$objUsuarioRotinaControl = new UsuarioRotinaControl($objUsuarioRotina);

		$objUsuarioRotinaControl->deletarPorUsuarioRotina();

	}
		
}


?>