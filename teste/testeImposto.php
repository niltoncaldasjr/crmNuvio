<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ImpostoControl.php';

// INSTANCIA DE IMPOSTO(1);

$imposto = new Imposto();
$imposto->setId(1);
$imposto->setAliquotaICMS(3.5);
$imposto->setAliquotaPIS(1.2);
$imposto->setaliquotaCOFINS(1.4);
$imposto->setAliquotaCSLL(1.5);
$imposto->setAliquotaISS(3.8);
$imposto->setAliquotaIRPJ(5.1);
$imposto->setDatacadastro(date ( "Y-m-d H:i:s" ));
$imposto->setDataedicao(date ( "Y-m-d H:i:s" ));

echo $imposto->getAliquotaPIS() + $imposto->getAliquotaCSLL();



echo '<h3>Funcao Serialize</h3>';
$imposto->jsonSerialize ();

// chamou a control
$impostoControl = new ImpostoControl ( $imposto );

echo '<h3>Cadastra um novo IMPOSTO</h3>';


$id = $impostoControl->cadastrar ();

echo '<h3>Id do Imposto cadastrado: ' . $id . '</h3>';

echo '<h3>Procura Imposto do ultimo id cadastrado</h3>';
$busca = new Imposto ( $id );
$buscaporId = new ImpostoControl ( $busca );

$achouImposto = $buscaporId->buscarPorId();
echo "Imposto Encontrado...";

echo '<h3>Atualiza Usuario</h3>';
$atualize = new Imposto ( $id, 3.25, 4.56, 7.89, 9.87, 6.50, 7.35, null, date ( "Y-m-d H:i:s" ));
$atualizarImposto = new ImpostoControl ( $atualize );
$atualizarImposto->atualizar ();
$atualizado = $atualizarImposto->buscarPorId ();
var_dump ( $atualizado );

echo '<h3>Listar Todos os Impostos</h3>';
$procura = new Imposto ( null, 'teste' );
$procurarControl = new ImpostoControl ( $procura );
$listaImpostos = $procurarControl->listarTodos();
var_dump ( $listaImpostos );

/**
 * DELETAR> Pega o ultimo Id cadastrado e
 * subtrai 1, e passa para o controler apagar 
 */ 
$id = $id - 1;
echo '<h3>Deleta o penultimo IMPOSTO cadastrado. Id: '. $id .'</h3>';

$deleta = new Imposto($id);
$deletarControl = new ImpostoControl($deleta);
$deletarControl->deletar();
