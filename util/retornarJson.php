<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';

class RetornarJson{
	private $link;
	private $perfil;
	
	function __construct($perfil){
		$this->link = Conexao::getInstance ()->getConexao ();
		$this->perfil = $perfil;
	}
	
	public function retornarPerfilRotinas(){
		$lista = array();			
		$query = sprintf ( "SELECT * FROM perfilrotina WHERE idperfil = $this->perfil" );
		
		$result = mysqli_query ( $this->link, $query );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->link ) );
		}
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			if ($row ['consulta'] == 0) {
				$row ['consulta'] = true;
			} else if ($row ['consulta'] == 1) {
				$row ['consulta'] = false;
			}
		
			if ($row ['incluir'] == 0) {
				$row ['incluir'] = true;
			} else if ($row ['incluir'] == 1) {
				$row ['incluir'] = false;
			}
		
			if ($row ['alterar'] == 0) {
				$row ['alterar'] = true;
			} else if ($row ['alterar'] == 1) {
				$row ['alterar'] = false;
			}
		
			if ($row ['excluir'] == 0) {
				$row ['excluir'] = true;
			} else if ($row ['excluir'] == 1) {
				$row ['excluir'] = false;
			}
			// ************
			$rotina = new Rotina($row['idrotina']);
			$rcontrol = new RotinaControl($rotina);
			$rotina = $rcontrol->buscarPorId();
			
			//*************
			
			$row['nome'] = $rotina->getNome();
			$lista [] = $row; // pronto essa lista vai direto pro ENCODE
		}
		return $lista;
	}
	
	public function retornarRotinas(){
		
		/** buscar as rotinas **/
		$queryString = "SELECT e.* FROM perfil u ";
		$queryString .= "INNER JOIN perfilrotina eu ON u.id = eu.idperfil ";
		$queryString .= "INNER JOIN rotina e ON eu.idrotina = e.id ";
		$queryString .= "WHERE u.id = '$this->perfil' ";
		
		$empresas	= array();
		$empresas2 	= array();
		
		if($resultdb = mysqli_query ( $this->link, $queryString )){
		
			$empresaUsuario = "(";
			while($row = $resultdb->fetch_assoc()){
				
				$empresas[] = $row;
				$empresaUsuario .= $row['id'] . ",";		
			}
		
			$empresaUsuario = substr($empresaUsuario, 0, -1) . ")";
		
			if($empresaUsuario == ")"){$empresaUsuario = "( 0 )";}
		
			$newquery = "SELECT * FROM rotina WHERE id NOT IN $empresaUsuario";
		
			if($resultdb = mysqli_query($this->link, $newquery)){
		
				while($empresa = $resultdb->fetch_assoc()){
					
					$empresas2[] = $empresa;
						
				}
			}
		
			$success = 'true';
			$msg = 'Sucesso';
		
			/*-- Encodamos para o json --*/
		}else{
			$success = 'false';
			$msg = 'Nenhum dado encontrado';
		}
		return $empresas2;
	}



}