<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EnderecoPFControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/enderecopf/EnderecoPF.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaEnderecoPF();
			break;
	
		case 'POST':
			cadastraEnderecoPF();
			break;
	
		case 'PUT':
			atualizaEnderecoPF();
			break;
				
		case 'DELETE':
			deletaEnderecoPF();
			break;
}
	
function listaEnderecoPF() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objEnderecoPFControl = new EnderecoPFControl();
	$listaBanco = $objEnderecoPFControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaBanco as $objEnderecoPF) {
		$v_registros[] = $objEnderecoPF;
	}
	
	$objEnderecoPFControl = new EnderecoPFControl();
	$totalRegistro = $objEnderecoPFControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraEnderecoPF() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
	
	$dataemissao = $data->dataemissao;
	$dataemissao = preg_replace("/\D+/", "", $dataemissao); // remove qualquer caracter nãoo numérico
		
	$objEnderecoPF = new EnderecoPF();
	$objEnderecoPF->setTipo($data->tipo);
	$objEnderecoPF->setLogradouro($data->logradouro);
	$objEnderecoPF->setNumero($data->numero);
	$objEnderecoPF->setComplemento($data->complemento);
	$objEnderecoPF->setBairro($data->bairro);
	$objEnderecoPF->setCep($data->cep);
	$objEnderecoPF->setObjlocalidade( new Localidade($data->idlocalidade));
	$objEnderecoPF->setObjpessoafisica( new PessoaFisica($data->idpessoafisica) );
	
	$objEnderecoPFControl = new EnderecoPFControl($objEnderecoPF);
	$id = $objEnderecoPFControl->cadastrar();
	
	$objEnderecoPF->setId($id);
	
	$jsonDepois = json_encode( $objEnderecoPF );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objEnderecoPF), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objEnderecoPF
	));
	
}

function atualizaEnderecoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );

	$jsonDepois = json_encode( $data );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objEnderecpPF = new EnderecoPF($data->id, $data->tipo, $data->logradouro, $data->numero, $data->complemento, $data->bairro, $data->cep,  new Localidade( $data->idlocalidade ), new PessoaFisica($data->idpessoafisica), NULL, $datahora );
	
	$objEnderecoPFControl = new EnderecoPFControl($objEnderecpPF);

	$jsonAntes = json_encode( $objEnderecoPFControl->BuscarPorID() );

	$objEnderecoPFControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objEnderecpPF), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaEnderecoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objEnderecoPF = new EnderecoPF();
	$objEnderecoPF->setId($id);
	
	$objEnderecoPFControl = new EnderecoPFControl($objEnderecoPF);

	$jsonAntes = json_encode( $objEnderecoPFControl->BuscarPorID() );

	$objEnderecoPFControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objEnderecoPF), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>