<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

// instanciando um objeto PERFIL
$perfil = new Perfil ();
$perfil->setId ( 1 );
$perfil->setNome ( 'Gerente' );
$perfil->setAtivo ( 1 );
$perfil->setDatacadastro( date ( "Y-m-d H:i:s" ) );
$perfil->setDataedicao ( date ( "Y-m-d H:i:s" ) );
echo '<h3>Funcao Serialize</h3>';
$per = $perfil->jsonSerialize ();
var_dump ( $per );

echo '<h3>Passando o objeto para um array</h3>';
$array [] = $perfil;
var_dump ( $array );
echo '<h3>depois imprimindo como JSON</h3>';
$json = json_encode ( $array );
echo $json;

// chamou a control
$perfilcontrol = new PerfilControl ( $perfil );

echo '<h3>Cadastra um novo perfil</h3>';

$string = $perfil->__toString (); // imprime com a funcao TOSTRING
echo $string;

$id = $perfilcontrol->cadastrar ();
echo '<h3>Id do perfil cadastrado: ' . $id . '</h3>';

echo '<h3>Procura perfil do ultimo id cadastrado</h3>';
$p = new Perfil ( $id );
$buscaporId = new PerfilControl ( $p );

$perf = $buscaporId->buscarPorId ();
var_dump ( $perf );

echo '<h3>Atualiza perfil</h3>';
$p_atualize = new Perfil ( $id, 'Diretor', 0, null, date ( "Y-m-d H:i:s" ) );
$atualizar = new PerfilControl ( $p_atualize );
$atualizar->atualizar ();
$atualizado = $atualizar->buscarPorId ();
var_dump ( $atualizado );

echo '<h3>Pesquisa por nome perfil</h3>';
$procura = new Perfil ( null, 'teste' );
$procurarControl = new PerfilControl ( $procura );
$listaDeNomes = $procurarControl->listarPorPessoa ();
var_dump ( $listaDeNomes );

/**
 * DELETAR> Pega o ultimo Id cadastrado e
 * subtrai 1, e passa para o controler apagar 
 */ 
$id = $id - 1;
echo '<h3>Deleta o penultimo perfil cadastrado. Id: '. $id .'</h3>';

$deleta = new Perfil($id);
$deletarControl = new PerfilControl($deleta);
$deletarControl->deletar();


