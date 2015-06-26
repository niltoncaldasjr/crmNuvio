<?php
class EmpresaUsuario implements JsonSerializable{
	
	private $id;
	private $objEmpresa;
	private $objUsuario;
	private $datacadastro;
	
        function __construct($id=null, Empresa $objEmpresa=null, Usuario $objUsuario=null, $datacadastro=null) {
            $this->id = $id;
            $this->objEmpresa = $objEmpresa;
            $this->objUsuario = $objUsuario;
            $this->datacadastro = $datacadastro;
        }
        
        function getId() {
            return $this->id;
        }

        function getObjEmpresa() {
            return $this->objEmpresa;
        }

        function getObjUsuario() {
            return $this->objUsuario;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setObjEmpresa($objEmpresa) {
            $this->objEmpresa = $objEmpresa;
        }

        function setObjUsuario($objUsuario) {
            $this->objUsuario = $objUsuario;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

                
        public function toString()
        {
        	return sprintf("EmpresaUsuario: [ID: %d, DataCadastro: %s, Empresa: %s[ID:%d], Usuario: %s[ID:%d]]", $this->id, $this->datacadastro,  $this->objEmpresa->getNomeFantasia(), $this->objEmpresa->getId(), $this->objUsuario->getNome(), $this->objUsuario->getId());
        }

                
	public function jsonSerialize() {
		$empresausuario [] = [ 
				'id' => $this->id,
				'idempresa' => $this->objEmpresa,
				'idusuario' => $this->objUsuario,
				'datacadastro' => $this->datacadastro 
		];
		$json = json_encode ( $empresausuario );
		echo $json;
	}
}