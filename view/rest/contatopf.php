<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ContatoPFControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/contatopf/ContatoPF.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaContatoPF();
			break;
	
		case 'POST':
			cadastraContatoPF();
			break;
	
		case 'PUT':
			atualizaContatoPF();
			break;
				
		case 'DELETE':
			deletaContatoPF();
			break;
}
	
function listaContatoPF() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$idpessoafisica = $_REQUEST['pessoafisicaid'];

	echo $idpessoafisica;

	$objContatoPFControl = new ContatoPFControl();
	$listaBanco = $objContatoPFControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaBanco as $objBanco) {
		$v_registros[] = $objBanco;
	}
	
	$objContatoPFControl = new ContatoPFControl();
	$totalRegistro = $objContatoPFControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraContatoPF() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
		
	$objContatoPF = new ContatoPF();
	$objContatoPF->setTipo($data->tipo);
	$objContatoPF->setOperadora($data->operadora);
	$objContatoPF->setContato($data->contato);
	$objContatoPF->setObjpessoafisica( new PessoaFisica($data->idpessoafisica) );
	
	
	$objContatoPFControl = new ContatoPFControl($objContatoPF);
	$id = $objContatoPFControl->cadastrar();
	
	$objContatoPF->setId($id);
	
	$jsonDepois = json_encode( $objContatoPF );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objContatoPF), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objContatoPF
	));
	
}

function atualizaContatoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );

	$jsonDepois = json_encode( $data );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objContatoPF = new ContatoPF($data->id, $data->tipo, $data->operadora, $data->contato, new PessoaFisica($data->idpessoafisica), NULL, $datahora );
	
	$objContatoPFControl = new ContatoPFControl($objContatoPF);

	$jsonAntes = json_encode( $objContatoPFControl->BuscarPorID() );

	$objContatoPFControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objContatoPF), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaContatoPF() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objContatoPF = new ContatoPF();
	$objContatoPF->setId($id);
	
	$objContatoPFControl = new ContatoPFControl($objContatoPF);

	$jsonAntes = json_encode( $objContatoPFControl->BuscarPorID() );

	$objContatoPFControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objContatoPF), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>