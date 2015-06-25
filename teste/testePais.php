<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pais/Pais.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PaisControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

// instanciando um objeto USUARIO

$pais = new Pais();
$pais->setId(1);
$pais->setDescricao('Brasil');
$pais->setNacionalidade('Brasileiro');
$pais->setDatacadastro(date ( "Y-m-d H:i:s" ));
$pais->setDataedicao(date ( "Y-m-d H:i:s" ));

echo '<h3>Funcao Serialize</h3>';
$pais->jsonSerialize ();

// chamou a control
$paisControl = new PaisControl ( $pais );

echo '<h3>Cadastra um novo PAIS</h3>';

// // $string = $perfil->__toString (); // imprime com a funcao TOSTRING
// // echo $string;

$id = $paisControl->cadastrar ();
echo '<h3>Id da País cadastrado: ' . $id . '</h3>';

//***************************************
echo "  ***** LISTAR TODOS ################";



// $completo = $cont->listarTodos();
$completo = $paisControl->listarTodos();
var_dump($completo);

echo "#### fim listar Todos ######";
//***********************************************
echo '<h3>Procura Pais do ultimo id cadastrado</h3>';
$busca = new Pais( $id );
$buscaporId = new PaisControl ( $busca );

$achouPais = $buscaporId->buscarPorId ();
var_dump ( $achouPais );

echo '<h3>Atualiza Pais</h3>';
$atualize = new Pais ( $id, 'DB', 'DB Supermercados', 'DB', '76443624000145','951357852258', '654852', 'Rua Maceio', '150', 'prox. do shop', 'Adrianopolis', '69057-000', '..imagens/bd_logo.png' ,'bd_user' , date ( "Y-m-d H:i:s" ), 6, 1 );
$atualizarPais = new PaisControl ( $atualize );

$atualizarPais->atualizar ();  // DESCOMENTAR QUANDO CONSERTAR O BANCO

$atualizado = $atualizarPais->buscarPorId ();
var_dump ( $atualizado );

echo '<h3>Pesquisa por nome de Pais ("Teste")</h3>'; // adicione a palavra Teste em alguns registro no banco
$procura = new Pais ( null, 'Teste' );
$procurarControl = new PaisControl ( $procura );
$listaDeNomes = $procurarControl->listarPorPessoa ();
var_dump ( $listaDeNomes );

/**
 * DELETAR> Pega o ultimo Id cadastrado e
 * subtrai 1, e passa para o controler apagar 
 */ 
$id = $id - 1;
echo '<h3>Deleta o penultima PAIS cadastrado. Id: '. $id .'</h3>';

$deleta = new Pais($id);
$deletarControl = new PaisControl($deleta);
$deletarControl->deletar();