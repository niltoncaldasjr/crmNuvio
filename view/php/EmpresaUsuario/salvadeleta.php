<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaUsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/empresausuario/EmpresaUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/usuario/Usuario.php';
/*-- Sessao --*/
session_start();

$data =  json_decode( $_POST['data'] );
$metodo = $_GET['metodo'];


switch($metodo)
{
	case "post": {
		SalvaEmpresaUsuario($data);
		break;
	}
	case "delete": {
		DeletaEmpresaUsuario($data);
		break;
	}
}

/*-- Metodo de cadastro da EmpresaUsuario --*/
function SalvaEmpresaUsuario($data){
	// echo "Vamos cadastrar";
	foreach ($data as $key) {
		$objEmpresa = new Empresa();
		$objUsuario = new Usuario();
		$objEmpresaUsuario = new EmpresaUsuario();

		$objEmpresa->setId($key->idempresa);
		$objUsuario->setId($key->idusuario);
		$objEmpresaUsuario->setObjEmpresa($objEmpresa);
		$objEmpresaUsuario->setObjUsuario($objUsuario);

		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);

		$objEmpresaUsuarioControl->cadastrar();

	}
}

/*-- Metodos de delete da EmpresaUsuario --*/
function DeletaEmpresaUsuario($data){
	// echo "Vamos deletar";
	foreach ($data as $key) {
		$objEmpresa = new Empresa();
		$objUsuario = new Usuario();
		$objEmpresaUsuario = new EmpresaUsuario();

		$objEmpresa->setId($key->idempresa);
		$objUsuario->setId($key->idusuario);
		$objEmpresaUsuario->setObjEmpresa($objEmpresa);
		$objEmpresaUsuario->setObjUsuario($objUsuario);

		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);

		$objEmpresaUsuarioControl->deletarPorEmpresaUsuario();

	}
		
}


?>