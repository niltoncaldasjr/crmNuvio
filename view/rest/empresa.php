<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

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
	$object->setInscricaoEstadual($data->inscricaoEstadual);
	$object->setInscricaoMunicipal($data->inscricaoMunicipal);
	$object->setEndereco($data->endereco);
	$object->setNumero($data->numero);
	$object->setComplemento($data->complemento);
	$object->setBairro($data->bairro);
	$object->setCep($data->cep);
	$object->setImagemLogotipo($data->imagemLogotipo);
	$object->setObjLocalidade(new Localidade($data->idlocalidade));
	$object->setObjImposto(new Imposto($data->idimposto));
	// INSERI O OBJETO NO CONTROL 
	// E CHAMA O METODO CADASTRAR
	$controller = new EmpresaControl($object);
	$id = $controller->cadastrar();
	
	// RETORNA O id CADASTRADO PARA O OBJETO
	$object->setId($id);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $object
	));
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Inclusуo de registro na Classe Empresa.');
	$log->setNivel('BASICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
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
	$object->setInscricaoEstadual($data->inscricaoEstadual);
	$object->setInscricaoMunicipal($data->inscricaoMunicipal);
	$object->setEndereco($data->endereco);
	$object->setNumero($data->numero);
	$object->setComplemento($data->complemento);
	$object->setBairro($data->bairro);
	$object->setCep($data->cep);
	$object->setImagemLogotipo($data->imagemLogotipo);
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$object->setObjLocalidade(new Localidade($data->idlocalidade));
	$object->setObjImposto(new Imposto($data->idimposto));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new EmpresaControl($object);
	$controller->atualizar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Alteraчуo de registro na Classe Empresa.');
	$log->setNivel('MODERADO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

function deletaEmpresa() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	// INSERI O id NO OBJETO
	$object = new Empresa();
	$object->setId($id);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new EmpresaControl($object);
	$controller->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclusуo de registro na Classe Empresa.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

?>