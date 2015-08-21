<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Empresa/Empresa.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaEmpresa();
			break;
	
		case 'POST':
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

function deletaEmpresa() {
	
	$data = $_POST['data'];
	$data = json_decode($data);
	$id = $data->id;
	
	// INSERI O id NO OBJETO
	$object = new Empresa();
	$object->setId($id);
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
	$object->setDataedicao(date('Y-m-d H:m:s'));
	$object->setObjLocalidade(new Localidade($data->idlocalidade));
	$object->setObjImposto(new Imposto($data->idimposto));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new EmpresaControl($object);
	$empresaAntes = $controller->buscarPorId();
	$controller->deletar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($empresaAntes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
}
?>