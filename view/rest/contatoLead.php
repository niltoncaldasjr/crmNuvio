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
	$data = json_decode(stripslashes($jsonDados));
		
	$d_forContato = explode('/', $data->datacontato);
	
	$dia = $d_forContato[0];
	$mes = $d_forContato[1]; 
	$ano = $d_forContato[2];
	
	$result_data = $ano."-".$mes."-".$dia;
	
	$d_forRetorno = explode('/', $data->dataretorno);
	
	$dia = $d_forRetorno[0];
	$mes = $d_forRetorno[1];
	$ano = $d_forRetorno[2];
	
	$result_dataRetorno = $ano."-".$mes."-".$dia;
	
	
	
	$objContatoLead = new ContatoLead();
	$objContatoLead->setDatacontato($result_data);
	$objContatoLead->setDescricao($data->descricao);
	$objContatoLead->setDataretorno($result_dataRetorno);
	$objUsuario = new Usuario($data->idusuario);
	$objContatoLead->setObjUsuario($objUsuario);
	$objLead = new Lead($data->idlead);
	$objContatoLead->setObjLead($objLead);
	
	$objContaContatoLeadControl = new ContatoLeadControl($objContatoLead);
	$objContatoLead = $objContaContatoLeadControl->cadastrar();
	
	//$objContatoLead->setId($objContaContatoLeadControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objContatoLead
	));
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia('Inclusуo de registro na Classe ContatoLead');
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function atualizaContatoLead() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$datahora = date("Y-m-d H:i:s");
	
	$d_forContato = explode('/', $data->datacontato);
	
	$dia = $d_forContato[0];
	$mes = $d_forContato[1];
	$ano = $d_forContato[2];
	
	$result_data = $ano."-".$mes."-".$dia;
	
	$d_forRetorno = explode('/', $data->dataretorno);
	
	$dia = $d_forRetorno[0];
	$mes = $d_forRetorno[1];
	$ano = $d_forRetorno[2];
	
	$result_dataRetorno = $ano."-".$mes."-".$dia;
	
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
	$objLogSistema->setOcorrencia('Alteraчуo de registro na Classe ContatoLead');
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
	$objLogSistema->setOcorrencia('Exclusуo de registro na Classe ContatoLead: ID '.$id);
	$objLogSistema->setNivel('CRITICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

?>