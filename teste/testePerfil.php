<?php
require_once '../model/perfil/Perfil.php';
require_once '../model/perfil/PerfilDAO.php';
require_once '../control/PerfilControl.php';
require_once '../util/Conexao.php';

 
// instanciando um objeto PERFIL
$perfil = new Perfil();
$perfil->setId(3);
$perfil->setNome('Administrador');
$perfil->setAtivo(1);
$perfil->setDatacadastrado(date("Y-m-d H:i:s"));
$perfil->setDataedicao(date("Y-m-d H:i:s"));

echo 'Funcao Serialize';
$per = $perfil->jsonSerialize();
var_dump( $per );

echo 'Funcao TOSTRING <br>';
$string = $perfil->__toString();
echo $string;
echo '<br>';
echo 'Passando o objeto para um array';
$array[] = $perfil;
var_dump($array);
echo 'depois imprimindo como JSON <br>';
$json = json_encode($array);
echo $json;

echo '<br>';
$con = Conexao::getInstance()->getConexao();

$dao = new PerfilDAO($con);
// $id = $dao->cadastrar($perfil);
echo "ULTIMO: " . $id;
$lista = $dao->listarTodos();
var_dump($lista);


