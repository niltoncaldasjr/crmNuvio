<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/DocumentoPFControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/documentopf/DocumentoPF.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaDocumentoPF();
			break;
	
		case 'POST':
			cadastraDocumentoPF();
			break;
	
		case 'PUT':
			atualizaDocumentoPF();
			break;
				
		case 'DELETE':
			deletaDocumentoPF();
			break;
}
	
function listaDocumentoPF() {
	
	$idpessoafisica = $_REQUEST['idpessoafisica'];
	

	$objDocumentoPFControl = new DocumentoPFControl();
	$listaBanco = $objDocumentoPFControl->listarPorPessoarFisica($idpessoafisica);
	
	$v_registros = array();
	
	foreach ($listaBanco as $objDocumentoPF) {
		$v_registros[] = $objDocumentoPF;
	}
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $v_registros
	));
	
}

function cadastraDocumentoPF() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
	
	$dataemissao = $data->dataemissao;
	$dataemissao = preg_replace("/\D+/", "", $dataemissao); // remove qualquer caracter nãoo numérico
		
	$objDocumentoPF = new DocumentoPF();
	$objDocumentoPF->setTipo($data->tipo);
	$objDocumentoPF->setNumero($data->numero);
	$objDocumentoPF->setDataemissao($dataemissao);
	$objDocumentoPF->setOrgaoemissor($data->orgaoemissor);
	$objDocumentoPF->setVia($data->via);
	$objDocumentoPF->setObjpessoafisica( new PessoaFisica($data->idpessoafisica) );
	
	$objDocumentoPFControl = new DocumentoPFControl($objDocumentoPF);
	$id = $objDocumentoPFControl->cadastrar();
	
	$objDocumentoPF->setId($id);
	
	$jsonDepois = json_encode( $objDocumentoPF );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objDocumentoPF), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objDocumentoPF
	));
	
}

function atualizaDocumentoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );

// 	$jsonDepois = json_encode( $data );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objDocumentoPF = new DocumentoPF($data->id, $data->tipo, $data->numero, $data->dataemissao, $data->orgaoemissor, $data->via, new PessoaFisica($data->idpessoafisica), NULL, $datahora );
	
	$objDocumentoPFControl = new DocumentoPFControl($objDocumentoPF);

	$jsonAntes = json_encode( $objDocumentoPFControl->BuscarPorID() );
	
	$jsonDepois = json_encode( $objDocumentoPF );

	$objDocumentoPFControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objDocumentoPF), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaDocumentoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
// 	$data = json_decode(stripslashes($jsonDados));

	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objDocumentoPF = new DocumentoPF();
	$objDocumentoPF->setId($id);
	
	$objDocumentoPFControl = new DocumentoPFControl($objDocumentoPF);

	$jsonAntes = json_encode( $objDocumentoPFControl->BuscarPorID() );
	$jsonDepois = $jsonAntes;

	$objDocumentoPFControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objDocumentoPF), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>