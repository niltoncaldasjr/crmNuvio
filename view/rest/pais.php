<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PaisControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pais/Pais.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPais();
			break;
	
		case 'POST':
			cadastraPais();
			break;
	
		case 'PUT':
			atualizaPais();
			break;
				
		case 'DELETE':
			deletaPais();
			break;
}
	
function listaPais() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$o_paisControl = new PaisControl();
	$v_o_pais = $o_paisControl->listarPaginado($start, $limit);
	

	$o_paisControl = new PaisControl();
	$totalRegistro = $o_paisControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_o_pais
	));
	
}

function cadastraPais() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	$datacadastro = date("Y-m-d H:i:s");
	$dataedicao = date("Y-m-d H:i:s");
	
	$o_pais = new Pais();
	$o_pais->setDescricao($data->descricao);
	$o_pais->setNacionalidade($data->nacionalidade);
	$o_pais->setDatacadastro($datacadastro);
	$o_pais->setDataedicao($dataedicao);
	
	$o_paisControl = new PaisControl($o_pais);
	$o_paisControl->cadastrar();
	
	$o_paisControl->setId($o_paisControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $o_pais
	));
	
}

function atualizaPais() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	$dataedicao = date("Y-m-d H:i:s");
	
	$o_pais = new Pais( $data->id, $data->descricao, $data->nacionalidade,NULL,$dataedicao);
	
	$o_paisControl = new PaisControl($o_pais);
	$o_paisControl->atualizar();
	
}

function deletaPais() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$o_pais = new Pais();
	$o_pais->setId($id);
	
	$o_paisControl = new PaisControl($o_pais);
	$o_paisControl->deletar();
	
}

?>