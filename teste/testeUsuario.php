<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';


// INSTANCIA DE PERFIL e PESSOAFISICA
$objPerfil = new Perfil(5);
$objPessoafisica = new PessoaFisica(1);

// Instanciando um objeto USUARIO
$user = new Usuario();
$user->setId(1);
$user->setNome('Nome do Usuario');
$user->setUsuario('admin');
$user->setSenha('admin');
$user->setEmail('admin@empresa.com');
$user->setAtivo(1);
$user->setObjPerfil($objPerfil);
$user->setObjPessoafisica($objPessoafisica);


echo '<h3>Funcao Serialize</h3>';
$user->jsonSerialize ();

// chamou a control
$usuarioControl = new UsuarioControl ( $user );

echo '<h3>Cadastra um novo USUARIO</h3>';

// // $string = $perfil->__toString (); // imprime com a funcao TOSTRING
// // echo $string;

$id = $usuarioControl->cadastrar ();

echo '<h3>Id do Usuario cadastrado: ' . $id . '</h3>';

echo '<h3>Procura Usuario do ultimo id cadastrado</h3>';
$busca = new Usuario ( $id );
$buscaporId = new UsuarioControl ( $busca );

$achouUsuario = $buscaporId->buscarPorId();
echo "Usuario: " . $achouUsuario->getNome() . " Encontrado...";

echo '<h3>Atualiza Usuario</h3>';
$novoperfil = new Perfil(5);
$atualize = new Usuario ( $id, 'Usuario Testando', 'user', 'user', 'user@empresa.com', 0, null, date ( "Y-m-d H:i:s" ),$novoperfil,null );
$atualizarUsuario = new UsuarioControl ( $atualize );
$atualizarUsuario->atualizar ();
$atualizado = $atualizarUsuario->buscarPorId ();
var_dump ( $atualizado );

echo '<h3>Pesquisa por nome Usuario</h3>';
$procura = new Usuario ( null, 'teste' );
$procurarControl = new UsuarioControl ( $procura );
$listaDeNomes = $procurarControl->listarPorPessoa ();
var_dump ( $listaDeNomes );

/**
 * DELETAR> Pega o ultimo Id cadastrado e
 * subtrai 1, e passa para o controler apagar 
 */ 
$id = $id - 1;
echo '<h3>Deleta o penultimo USUARIO cadastrado. Id: '. $id .'</h3>';

$deleta = new Usuario($id);
$deletarControl = new UsuarioControl($deleta);
$deletarControl->deletar();

echo '<h3>Listar todos Usuario</h3>';
$usertest =new Usuario(1,'Fabaino');
$listar = new UsuarioControl($usertest);
$todos = $listar->listarTodos();
var_dump($todos);
