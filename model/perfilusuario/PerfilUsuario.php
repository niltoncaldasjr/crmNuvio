<?php
class PerfilUsuario implements JsonSerializable{
	
		private $id;
		private $datacadastro;
        private $objPerfil;
        private $objUsuario;
        
        function __construct($id=null, $datacadastro=null, Perfil $objPerfil=null, Usuario $objUsuario=null) {
            $this->id = $id;
            $this->datacadastro = $datacadastro;
            $this->objPerfil = $objPerfil;
            $this->objUsuario = $objUsuario;
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

                
        public function toString()
        {
        	return sprintf("PerfilUsuario: [ID: %d, DataCadastro: %s, Perfil: %s[ID:%d], Usuario: %s[ID:%d]]", $this->id, $this->datacadastro,  $this->objPerfil->getNome(), $this->objPerfil->getId(), $this->objUsuario->getNome(), $this->objUsuario->getId());
        }

                
	public function jsonSerialize() {
		$perfilusuario [] = [ 
				'id' => $this->id,
                'datacadastro' => $this->datacadastro,
				'idperfil' => $this->objPerfil,
				'idusuario' => $this->objUsuario
				 
		];
		$json = json_encode ( $perfilusuario );
		echo $json;
	}  
}