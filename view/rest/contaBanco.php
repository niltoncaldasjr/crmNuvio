<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ContaBancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/contabanco/ContaBanco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/banco/Banco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/empresa/Empresa.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaContaBanco();
			break;
	
		case 'POST':
			cadastraContaBanco();
			break;
	
		case 'PUT':
			atualizaContaBanco();
			break;
				
		case 'DELETE':
			deletaContaBanco();
			break;
}
	
function listaContaBanco() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objContaContaBancoControl = new ContaBancoControl();
	$listaContaBanco = $objContaContaBancoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaContaBanco as $objContaBanco) {
		$v_registros[] = $objContaBanco;
	}
	
	$objContaContaBancoControl = new ContaBancoControl();
	$totalRegistro = $objContaContaBancoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraContaBanco() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode( $jsonDados );
		
	$objContaBanco = new ContaBanco();
	$objContaBanco->setAgencia($data->agencia);
	$objContaBanco->setdigitoAgencia($data->digitoAgencia);
	$objContaBanco->setNumeroConta($data->numeroConta);
	$objContaBanco->setdigitoConta($data->digitoConta);
	$objContaBanco->setNumeroCarteira($data->numeroCarteira);
	$objContaBanco->setNumeroConvenio($data->numeroConvenio);
	$objContaBanco->setNomeContato($data->nomeContato);
	$objContaBanco->setTelefoneContato($data->telefoneContato);
	$objBanco = new Banco($data->idbanco);
	$objContaBanco->setObjBanco($objBanco);
	$objEmpresa = new Empresa($data->idempresa);
	$objContaBanco->setObjEmpresa($objEmpresa);
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$id = $objContaContaBancoControl->cadastrar();
	
	$objContaBanco->setId( $id );
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objContaBanco
	));

	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Inclusão de registro na Classe ContaBanco' );
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
}

function atualizaContaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objContaBanco = new ContaBanco();
	$objContaBanco->setId($data->id);
	$objContaBanco->setAgencia($data->agencia);
	$objContaBanco->setdigitoAgencia($data->digitoAgencia);
	$objContaBanco->setNumeroConta($data->numeroConta);
	$objContaBanco->setdigitoConta($data->digitoConta);
	$objContaBanco->setNumeroCarteira($data->numeroCarteira);
	$objContaBanco->setNumeroConvenio($data->numeroConvenio);
	$objContaBanco->setNomeContato($data->nomeContato);
	$objContaBanco->setTelefoneContato($data->telefoneContato);
	$objContaBanco->setDataedicao($datahora);
	$objBanco = new Banco($data->idbanco);
	$objContaBanco->setObjBanco($objBanco);
	$objEmpresa = new Empresa($data->idempresa);
	$objContaBanco->setObjEmpresa($objEmpresa);
	
	//echo $objContaBanco;
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$objContaContaBancoControl->atualizar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Alteração de registro na Classe ContaBanco' );
	$objLogSistema->setNivel('MODERADO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function deletaContaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objContaBanco = new ContaBanco();
	$objContaBanco->setId($id);
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$objContaContaBancoControl->deletar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia( 'Exclusão de registro na Classe ContaBanco: ID '.$id );
	$objLogSistema->setNivel('CRITICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

?>