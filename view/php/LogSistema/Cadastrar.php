<?php
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

function CadastraLogSistema($class, $idregistro, $nivel, $acao, $jsonAntes, $jsonDepois){

	$objLogSistema = new LogSistema();
	$objLogSistema->setNivel( $nivel );
	$objLogSistema->setAcao( $acao );
	$objLogSistema->setClass( $class );
	$objLogSistema->setIdregistro( $idregistro );
	$objLogSistema->setAntes( $jsonAntes );
	$objLogSistema->setDepois( $jsonDepois );
	$objLogSistema->setObjUsuario( new Usuario( $_SESSION['usuario']['idusuario'] ) );

	$objLogSistemaControl = new LogSistemaControl( $objLogSistema );
	$objLogSistemaControl->cadastrar();
}

?>