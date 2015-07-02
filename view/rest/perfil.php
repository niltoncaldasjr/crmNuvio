<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPerfil();
			break;
	
		case 'POST':
			cadastraPerfil();
			break;
	
		case 'PUT':
			atualizaPerfil();
			break;
				
		case 'DELETE':
			deletaPerfil();
			break;
}
	
function listaPerfil() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$o_perfilControl = new PerfilControl();
	$v_o_perfil = $o_perfilControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($v_o_perfil as $o_perfil) {
		$v_registros[] = $o_perfil;
	}
	
	$o_perfilControl = new PerfilControl();
	$totalRegistro = $o_perfilControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraPerfil() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$o_perfil = new Pais();
	$o_perfil->setNome($data->descricao);
	$o_perfil->setNome($data->nacionalidade);	
	
	$o_perfilControl = new PerfilControl($o_perfil);
	$id = $o_perfilControl->cadastrar();
	
	$o_perfil->setId($id);
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $o_perfil
	));
	
}

function atualizaPerfil() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$o_perfil = new Perfil();
	$o_perfil->setId($data->id);
	$o_perfil->setNome($data->nome);
	$o_perfil->setAtivo($data->ativo);
	$o_perfilControl = new PerfilControl($o_perfil);
	$o_perfilControl->atualizar();
	
}

function deletaPerfil() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$o_perfil = new Perfil();
	$o_perfil->setId($id);
	
	$o_perfilControl = new PerfilControl($o_perfil);
	$o_perfilControl->deletar();
	
}

?>