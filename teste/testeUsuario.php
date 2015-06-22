<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

// instanciando um objeto USUARIO
$user = new Usuario();
$user->setId(1);
$user->setNome('Nome do Admin');
$user->setUsuario('admin');
$user->setSenha('admin');
$user->setEmail('admin@empresa.com');
$user->setAtivo(1);
$user->setDatacadastrado(date ( "Y-m-d H:i:s" ));
$user->setDataedicao(date ( "Y-m-d H:i:s" ));
$user->setIdperfil(1);
$user->setIdpessoafisica(1);
 

echo '<h3>Funcao Serialize</h3>';
$user->jsonSerialize ();

// chamou a control
$usuarioControl = new UsuarioControl ( $user );

echo '<h3>Cadastra um novo USUARIO</h3>';

// $string = $perfil->__toString (); // imprime com a funcao TOSTRING
// echo $string;

$id = $usuarioControl->cadastrar ();
echo '<h3>Id do Usuario cadastrado: ' . $id . '</h3>';

echo '<h3>Procura Usuario do ultimo id cadastrado</h3>';
$busca = new Usuario ( $id );
$buscaporId = new UsuarioControl ( $busca );

$achouUsuario = $buscaporId->buscarPorId ();
var_dump ( $achouUsuario );

echo '<h3>Atualiza Usuario</h3>';
$atualize = new Usuario ( $id, 'Usuario Testando', 'user', 'user', 'user@empresa.com', 0, date ( "Y-m-d H:i:s" ) );
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
