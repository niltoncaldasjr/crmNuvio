<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaEmpresa();
			break;
	
		case 'POST':
			cadastraEmpresa();
			break;
	
		case 'PUT':
			atualizaEmpresa();
			break;
				
		case 'DELETE':
			deletaEmpresa();
			break;
}
	
function listaEmpresa() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$controller = new EmpresaControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function cadastraEmpresa() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$object = new Empresa();
	$object->setNomeFantasia($data->nomeFantasia);
	$object->setRazaoSocial($data->razaoSocial);
	$object->setNomeReduzido($data->nomeReduzido);
	$object->setCNPJ($data->CNPJ);
	$object->setInscricaoEstatual($data->inscricaoEstadual);
	$object->setInscricaoMunicipal(new Perfil($data->inscricaoMunicipal));
	$object->setEndereco($data->endereco);
	$object->setNumero($data->numero);
	$object->setComplemento($data->complemento);
	$object->setBairro($data->bairro);
	$object->setCep($data->cep);
	$object->setImagemLogotipo($data->imagemLogotipo);
	$object->setObjLocalidade(new Localidade($data->idlocalidade));
	$object->setObjImposto(new Imposto($data->idimposto));
	
	$controller = new EmpresaControl($object);
	$id = $controller->cadastrar();
	
	$object->setId($id);
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $object
	));
	
}

function atualizaEmpresa() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$object = new Empresa();
	$object->setId($data->id);
	$object->setNomeFantasia($data->nomeFantasia);
	$object->setRazaoSocial($data->razaoSocial);
	$object->setNomeReduzido($data->nomeReduzido);
	$object->setCNPJ($data->CNPJ);
	$object->setInscricaoEstatual($data->inscricaoEstadual);
	$object->setInscricaoMunicipal(new Perfil($data->inscricaoMunicipal));
	$object->setEndereco($data->endereco);
	$object->setNumero($data->numero);
	$object->setComplemento($data->complemento);
	$object->setBairro($data->bairro);
	$object->setCep($data->cep);
	$object->setImagemLogotipo($data->imagemLogotipo);
	$object->setObjLocalidade(new Localidade($data->idlocalidade));
	$object->setObjImposto(new Imposto($data->idimposto));
	
	$controller = new EmpresaControl($object);
	$controller->atualizar();
	
}

function deletaEmpresa() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$object = new Empresa();
	$object->setId($id);
	
	$controller = new EmpresaControl($object);
	$controller->deletar();
	
}

?>