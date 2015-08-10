<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LeadControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/lead/Lead.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';


switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaLead();
			break;
	
		case 'POST':
			cadastraLead();
			break;
	
		case 'PUT':
			atualizaLead();
			break;
				
		case 'DELETE':
			deletaLead();
			break;
}
	
function listaLead() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objLeadControl = new LeadControl();
	$listaLead = $objLeadControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaLead as $objLead) {
		$v_registros[] = $objLead;
	}
	
	$objLeadControl = new LeadControl();
	$totalRegistro = $objLeadControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraLead() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode( $jsonDados );
		
	$objLead = new Lead();
	$objLead->setEmpresa($data->empresa);
	$objLead->setEmail($data->email);
	$objLead->setTelefone($data->telefone);
	$objLead->setContato($data->contato);
	$objLead->setAtivo($data->ativo);
	
	$objLeadControl = new LeadControl($objLead);
	$id = $objLeadControl->cadastrar();
	
	$objLead->setId( $id );
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objLead
	));
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Inclusão de registro na Classe Lead' );
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function atualizaLead() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objLead = new Lead($data->id, $data->empresa, $data->email, $data->telefone, $data->contato, NULL, $datahora,  $data->ativo );
	
	$objLeadControl = new LeadControl($objLead);
	$objLeadControl->atualizar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Alteração de registro na Classe Lead' );
	$objLogSistema->setNivel('MODERADO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function deletaLead() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objLead = new Lead();
	$objLead->setId($id);
	
	$objLeadControl = new LeadControl($objLead);
	$objLeadControl->deletar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Exclusão de registro na Classe Lead: ID '.$id );
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

?>