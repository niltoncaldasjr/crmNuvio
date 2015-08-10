<?php

/*-- Sessao --*/
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/rotina/Rotina.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaRotina();
			break;
	
		case 'POST':
			cadastraRotina();
			break;
	
		case 'PUT':
			atualizaRotina();
			break;
				
		case 'DELETE':
			deletaRotina();
			break;
}
	
function listaRotina() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objRotinaControl = new RotinaControl();
	$listaRotina = $objRotinaControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaRotina as $objRotina) {
		$v_registros[] = $objRotina;
	}
	
	$objRotinaControl = new RotinaControl();
	$totalRegistro = $objRotinaControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
	
}

function cadastraRotina() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode( $jsonDados );
		
	$objRotina = new Rotina();
	$objRotina->setNome($data->nome);
	$objRotina->setDescricao($data->descricao);
	$objRotina->setOrdem($data->ordem);
	$objRotina->setUrl($data->url);
	$objRotina->setAtivo($data->ativo);
	
	$objRotinaControl = new RotinaControl($objRotina);
	$id = $objRotinaControl->cadastrar();
	
	$objRotina->setId( $id );
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objRotina
	));
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Inclusуo de registro na Classe Rotina') );
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
	
}

function atualizaRotina() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$datahora = date("Y-m-d H:i:s");
	
	$objRotina = new Rotina($data->id, $data->nome, $data->descricao, $data->ordem, $data->url, $data->ativo , NULL, $datahora );
	
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotinaControl->atualizar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Alteraчуo de registro na Classe Rotina.') );
	$objLogSistema->setNivel('MODERADO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function deletaRotina() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objRotina = new Rotina();
	$objRotina->setId($id);
	
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotinaControl->deletar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Exclusуo de resgistro na Classe Rotina: ID '.$id) );
	$objLogSistema->setNivel('CRITICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
}

?>