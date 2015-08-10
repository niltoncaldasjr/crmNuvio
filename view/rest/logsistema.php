<?php
/*-- Sessao --*/
session_start();
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaLogSistema();
			break;
	
		case 'POST':
			cadastraLogSistema();
			break;
	
		case 'PUT':
			atualizaLogSistema();
			break;
				
		case 'DELETE':
			deletaLogSistema();
			break;
}
	
function listaLogSistema() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objLogSistemaControl = new LogSistemaControl();
	$listaLog = $objLogSistemaControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaLog as $objLogSistema) {

		$v_registros[] = $objLogSistema;
	}
	
	$objLogSistemaControl = new LogSistemaControl();
	$totalRegistro = $objLogSistemaControl->qtdTotal();
	
	//var_dump($v_registros);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraLogSistema() {
	
	// $jsonDados = $_POST['data'];
	// $data = json_decode(stripslashes($jsonDados));
		
	// $objBanco = new Banco();
	// $objBanco->setNome($data->nome);
	// $objBanco->setCodigoBancoCentral($data->codigoBancoCentral);
	
	// $objBancoControl = new BancoControl($objBanco);
	// $id = $objBancoControl->cadastrar();
	
	// $objBanco->setId($id);
	
	
	// // encoda para formato JSON
	// echo json_encode(array(
	// 		"success" => 0,
	// 		"data" => $objBanco
	// ));
	
	// // Resginstando Log do Sistema
	// $objLogSistema = new LogSistema();
	// $objLogSistema->setOcorrencia('Inclusão de registro na Classe Banco');
	// $objLogSistema->setNivel('BASICO');
	// $objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	// $objLogSistemaController = new LogSistemaControl($objLogSistema);
	// $objLogSistemaController->cadastrar();
	
}

function atualizaLogSistema() {
	
	// parse_str(file_get_contents("php://input"), $post_vars);
	// $jsonDados = $post_vars['data'];
	// $data = json_decode(stripslashes($jsonDados));
	
	// $datahora = date("Y-m-d H:i:s");
	
	// $objBanco = new Banco($data->id, $data->nome, $data->codigoBancoCentral, NULL, $datahora );
	
	// $objBancoControl = new BancoControl($objBanco);
	// $objBancoControl->atualizar();
	
	// // Resginstando Log do Sistema
	// $objLogSistema = new LogSistema();
	// $objLogSistema->setOcorrencia('Alteração de registro na Classe Banco');
	// $objLogSistema->setNivel('MODERADO');
	// $objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	// $objLogSistemaController = new LogSistemaControl($objLogSistema);
	// $objLogSistemaController->cadastrar();
	
}

function deletaLogSistema() {
	
	// parse_str(file_get_contents("php://input"), $post_vars);
	// $jsonDados = $post_vars['data'];
	// $data = json_decode(stripslashes($jsonDados));
		
	// $id = $data->id;
	
	// $objBanco = new Banco();
	// $objBanco->setId($id);
	
	// $objBancoControl = new BancoControl($objBanco);
	// $objBancoControl->deletar();
	
	// // Resginstando Log do Sistema
	// $objLogSistema = new LogSistema();
	// $objLogSistema->setOcorrencia('Exclusão de registro na Classe Banco: ID '.$id);
	// $objLogSistema->setNivel('CRITICO');
	// $objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	// $objLogSistemaController = new LogSistemaControl($objLogSistema);
	// $objLogSistemaController->cadastrar();
	
}

?>