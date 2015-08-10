<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaEmpresa();
			break;
	
		case 'POST':
			deletaEmpresa();
			break;
}
	
function listaEmpresa() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	
	$controller = new EmpresaControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function deletaEmpresa() {
	
	$data = $_POST['data'];
	$data = json_decode($data);
	$id = $data->id;
	// INSERI O id NO OBJETO
	$object = new Empresa();
	$object->setId($id);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new EmpresaControl($object);
	$controller->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclusão de registro na Classe Empresa.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}
?>