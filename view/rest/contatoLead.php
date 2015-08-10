<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/ContatoLeadControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/contatolead/ContatoLead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/lead/Lead.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaContatoLead();
			break;
	
		case 'POST':
			cadastraContatoLead();
			break;
	
		case 'PUT':
			atualizaContatoLead();
			break;
				
		case 'DELETE':
			deletaContatoLead();
			break;
}
	
function listaContatoLead() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objContaContatoLeadControl = new ContatoLeadControl();
	$listaContatoLead = $objContaContatoLeadControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaContatoLead as $objContatoLead) {
		$v_registros[] = $objContatoLead;
	}
	
	$objContaContatoLeadControl = new ContatoLeadControl();
	$totalRegistro = $objContaContatoLeadControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraContatoLead() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode( $jsonDados );
		
	$d_forContato = $data->datacontato;
	
	$result_data = substr($d_forContato ,0,10); 
	
	$d_forRetorno = $data->dataretorno;
	
	$result_dataRetorno = substr($d_forRetorno ,0,10); 
	
	
	
	$objContatoLead = new ContatoLead();
	$objContatoLead->setDatacontato($result_data);
	$objContatoLead->setDescricao($data->descricao);
	$objContatoLead->setDataretorno($result_dataRetorno);
	$objUsuario = new Usuario($data->idusuario);
	$objContatoLead->setObjUsuario($objUsuario);
	$objLead = new Lead($data->idlead);
	$objContatoLead->setObjLead($objLead);
	
	$objContaContatoLeadControl = new ContatoLeadControl($objContatoLead);
	$id = $objContaContatoLeadControl->cadastrar();
	
	$objContatoLead->setId( $id );
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objContatoLead
	));
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Inclusão de registro na Classe ContatoLead') );
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function atualizaContatoLead() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$d_forContato = $data->datacontato;
	
	$result_data = substr($d_forContato ,0,10); 
	
	$d_forRetorno = $data->dataretorno;
	
	$result_dataRetorno = substr($d_forRetorno ,0,10); 
	
	$objContatoLead = new ContatoLead();
	$objContatoLead->setId($data->id);
	$objContatoLead->setDatacontato($result_data);
	$objContatoLead->setDescricao($data->descricao);
	$objContatoLead->setDataretorno($result_dataRetorno);
	$objContatoLead->setDataedicao($datahora);
	$objUsuario = new Usuario($data->idusuario);
	$objContatoLead->setObjUsuario($objUsuario);
	$objLead = new Lead($data->idlead);
	$objContatoLead->setObjLead($objLead);
	
	//echo $objContatoLead;
	
	$objContaContatoLeadControl = new ContatoLeadControl($objContatoLead);
	$objContaContatoLeadControl->atualizar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Alteração de registro na Classe ContatoLead') );
	$objLogSistema->setNivel('MODERADO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
}

function deletaContatoLead() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objContatoLead = new ContatoLead();
	$objContatoLead->setId($id);
	
	$objContaContatoLeadControl = new ContatoLeadControl($objContatoLead);
	$objContaContatoLeadControl->deletar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( utf8_encode('Exclusão de registro na Classe ContatoLead: ID '.$id) );
	$objLogSistema->setNivel('CRITICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

?>