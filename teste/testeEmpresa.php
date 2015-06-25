<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/Localidade.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

// instancia uma localidade
$locale = new Localidade(1);

// instancia um imposto
$imposto = new Imposto(1);



// instanciando um objeto USUARIO
$empresa = new Empresa();
$empresa->setId(1);
$empresa->setNomeFantasia('Bemol');
$empresa->setRazaoSocial('Benchimol e irmaos');
$empresa->setNomeReduzido('Bemol');
$empresa->setCNPJ('46973935000155');
$empresa->setInscricaoEstatual('123456789');
$empresa->setInscricaoMunicipal('987654321');
$empresa->setEndereco('Rua Eduardo Ribeiro');
$empresa->setNumero('1000');
$empresa->setComplemento('Proximo ao Bradesco');
$empresa->setBairro('Centro');
$empresa->setCep('69010-100');
$empresa->setImagemLogotipo('../imagens/bemol_logo.png');
$empresa->setDatacadastro(date ( "Y-m-d H:i:s" ));
$empresa->setDataedicao(date ( "Y-m-d H:i:s" ));
$empresa->setObjLocalidade($locale);
$empresa->setObjImposto($imposto);

echo '<h3>Funcao Serialize</h3>';
$empresa->jsonSerialize ();


// chamou a control
$empresaControl = new EmpresaControl ( $empresa );

echo '<h3>Cadastra um novo USUARIO</h3>';

// // $string = $perfil->__toString (); // imprime com a funcao TOSTRING
// // echo $string;

$id = $empresaControl->cadastrar ();
echo '<h3>Id da Empresa cadastrada: ' . $id . '</h3>';

//***************************************
echo "  ***** LISTAR TODOS ################";
$emp = new Empresa(16);
$cont = new EmpresaControl($emp);


// $completo = $cont->listarTodos();
$completo = $cont->listarDadosCompletos();
var_dump($completo);

echo "#### fim listar Todos ######";
//***********************************************
echo '<h3>Procura Empresa do ultimo id cadastrado</h3>';
$busca = new Empresa( $id );
$buscaporId = new EmpresaControl ( $busca );

$achouEmpresa = $buscaporId->buscarPorId ();
var_dump ( $achouEmpresa );

echo '<h3>Atualiza Empresa</h3>';
$atualize = new Empresa ( $id, 'DB', 'DB Supermercados', 'DB', '76443624000145','951357852258', '654852', 'Rua Maceio', '150', 'prox. do shop', 'Adrianopolis', '69057-000', '..imagens/bd_logo.png' ,date ( "Y-m-d H:i:s" ) , date ( "Y-m-d H:i:s" ), $locale, $imposto );
$atualizarEmpresa = new EmpresaControl ( $atualize );

$atualizarEmpresa->atualizar ();  // DESCOMENTAR QUANDO CONSERTAR O BANCO

$atualizado = $atualizarEmpresa->buscarPorId ();
var_dump ( $atualizado );

echo '<h3>Pesquisa por nome de Empresa ("Teste")</h3>'; // adicione a palavra Teste em alguns registro no banco
$procura = new Empresa ( null, 'Teste' );
$procurarControl = new EmpresaControl ( $procura );
$listaDeNomes = $procurarControl->listarPorPessoa ();
var_dump ( $listaDeNomes );

/**
 * DELETAR> Pega o ultimo Id cadastrado e
 * subtrai 1, e passa para o controler apagar 
 */ 
 if ($id>4){
		$id = $id - 1;
		echo '<h3>Deleta o penultima EMPRESA cadastrado. Id: '. $id .'</h3>';
		
		$deleta = new Empresa($id);
		$deletarControl = new EmpresaControl($deleta);
		$deletarControl->deletar();
 }
