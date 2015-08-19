<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';

/*-- Sessao --*/
session_start();

$mysqli = Conexao::getInstance()->getConexao();

$iduser = $_SESSION['usuario']['idusuario'];


//- PR-> 	usuariorotina
//- U-> 	Usu�rio
//- R-> 	Rotina

$queryString = "SELECT idrotina menuId FROM usuariorotina  ";
$queryString .= "WHERE idusuario = '$iduser' ";


$folder = array();
				

if($resultdb = $mysqli->query($queryString)){
	

	$in = "(";
	while($user = $resultdb->fetch_assoc()){
		$in .= $user['menuId'] . ",";
		//var_dump($in);
	}
	$in = substr($in, 0, -1) . ")";

	
	$resultdb->free();

	
	$sql = "SELECT * FROM rotina WHERE subrotina IS NULL ";
	$sql .= "AND id in $in";

	//var_dump($sql);
	
	if($resultdb = $mysqli->query($sql)){

		/*-- Retorna menu Principal $r --*/
		while($r = $resultdb->fetch_assoc()){
		
			$sqlquery = "SELECT * FROM rotina WHERE subrotina = ' ";
			$sqlquery .= $r['id'] . "' AND id in $in ";
			
			//var_dump($sqlquery);

			/*-- Nodes Submenus --*/
			if($nodes = $mysqli->query($sqlquery)){
				$count = $nodes->num_rows;

				//var_dump($count);
				
				if($count > 0){

					$r['leaf'] = false;
					$r['items'] = array();

					while($item = $nodes->fetch_assoc()){
						$item['leaf'] = true;
						$r['items'][] = $item;
						
// 						var_dump($r);
					}
				}
				$folder[] = $r;
				
				
			}
		}
	}

	//$resultdb->close();

	//mysql_close();

	/*-- Encodamos para o json --*/
	echo json_encode(array("items" => $folder));
}
?>