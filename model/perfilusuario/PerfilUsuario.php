<?php
class PerfilUsuario implements JsonSerializable{
	
		private $id;
		private $datacadastro;
        private $objPerfil;
        private $objUsuario;
        private $consulta;
        private $incluir;
        private $alterar;
        private $excluir;
        
        function __construct(
	        	$id=null, 
	        	$datacadastro=null, 
	        	Perfil $objPerfil=null, 
	        	Usuario $objUsuario=null,
        		$consulta = null,
        		$incluir = null,
        		$alterar = null,
        		$excluir = null        		
        	) 
		{
		        $this->id = $id;
		        $this->datacadastro = $datacadastro;
		        $this->objPerfil = $objPerfil;
		        $this->objUsuario = $objUsuario;
		        $this->consulta = $consulta;
		        $this->incluir = $incluir;
		        $this->alterar = $alterar;
		        $this->excluir = $excluir;
		}

        function getId() {
            return $this->id;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function getObjPerfil() {
            return $this->objPerfil;
        }

        function getObjUsuario() {
            return $this->objUsuario;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

        function setObjPerfil($objPerfil) {
            $this->objPerfil = $objPerfil;
        }

        function setObjUsuario($objUsuario) {
            $this->objUsuario = $objUsuario;
        }
        
        public function getConsulta() {
        	return $this->consulta;
        }
        public function setConsulta($consulta) {
        	$this->consulta = $consulta;
        }
        public function getIncluir() {
        	return $this->incluir;
        }
        public function setIncluir($incluir) {
        	$this->incluir = $incluir;
        }
        public function getAlterar() {
        	return $this->alterar;
        }
        public function setAlterar($alterar) {
        	$this->alterar = $alterar;
        }
        public function getExcluir() {
        	return $this->excluir;
        }
        public function setExcluir($excluir) {
        	$this->excluir = $excluir;
        }
                
        public function toString()
        {
        	return sprintf("PerfilUsuario: [ID: %d, DataCadastro: %s, Perfil: %s[ID:%d], Usuario: %s[ID:%d]]", $this->id, $this->datacadastro,  $this->objPerfil->getNome(), $this->objPerfil->getId(), $this->objUsuario->getNome(), $this->objUsuario->getId());
        }

                
	public function jsonSerialize() {
		return [ 
				'id' => $this->id,
                'datacadastro' => $this->datacadastro,
				'idperfil' => $this->objPerfil,
				'idusuario' => $this->objUsuario,
				'consulta'	=> $this->consulta,
				'incluir'	=> $this->incluir,
				'alterar'	=> $this->alterar,
				'excluir'	=> $this->excluir
				 
		];
		
	}
	
	  
}