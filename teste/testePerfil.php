<?php
require_once '../model/perfil/Perfil.php';
require_once '../control/PerfilControl.php';
require_once '../util/Conexao.php';

 
// instanciando um objeto PERFIL
$perfil = new Perfil();
$perfil->setId(1);
$perfil->setNome('Administrador');
$perfil->setAtivo(1);
$perfil->setDatacadastrado(date("Y-m-d H:i:s"));
$perfil->setDataedicao(date("Y-m-d H:i:s"));
echo '<h3>Funcao Serialize</h3>';
$per = $perfil->jsonSerialize();
var_dump( $per );



echo '<h3>Passando o objeto para um array</h3>';
$array[] = $perfil;
var_dump($array);
echo '<h3>depois imprimindo como JSON</h3>';
$json = json_encode($array);
echo $json;

// chamou a control
$perfilcontrol = new PerfilControl($perfil);

echo '<h3>Cadastra um novo perfil</h3>';

$string = $perfil->__toString(); // imprime com a funcao TOSTRING
echo $string;

$id = $perfilcontrol->cadastrar();
echo '<h3>Id do perfil cadastrado: ' . $id.'</h3>';

$p = new Perfil($id);
$buscaporId = new PerfilControl($p);

$perf =  $p->buscarPorId();
var_dump($perf);
echo '<h3>Atualiza perfil</h3>';
$lista = $perfilcontrol->listarTodos();
var_dump($lista);



