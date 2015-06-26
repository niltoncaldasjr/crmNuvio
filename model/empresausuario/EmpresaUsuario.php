<?php
class EmpresaUsuario implements JsonSerializable{
	
	private $id;
	private $odjEmpresa;
	private $objUsuario;
	private $datacadastro;
	
        function __construct($id=null, Empresa $odjEmpresa=null, Usuario $objUsuario=null, $datacadastro=null) {
            $this->id = $id;
            $this->odjEmpresa = $odjEmpresa;
            $this->objUsuario = $objUsuario;
            $this->datacadastro = $datacadastro;
        }
        
        function getId() {
            return $this->id;
        }

        function getOdjEmpresa() {
            return $this->odjEmpresa;
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

        function setOdjEmpresa($odjEmpresa) {
            $this->odjEmpresa = $odjEmpresa;
        }

        function setObjUsuario($objUsuario) {
            $this->objUsuario = $objUsuario;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }
        
        public function toString()
        {
//         	return sprintf("EmpresaUsuario: [ID: %d, DataCadastro: %s, Empresa: %s[ID:%d], Usuario: %s[ID:%d]]", $this->id, $this->datacadastro,  $this->, $this->objRotina->getId(), $this->objPerfil->getNome(), $this->objPerfil->getId());
        }

                
	public function jsonSerialize() {
		$empresausuario [] = [ 
				'id' => $this->id,
				'idempresa' => $this->odjEmpresa,
				'idusuario' => $this->objUsuario,
				'datacadastro' => $this->datacadastro 
		];
		$json = json_encode ( $empresausuario );
		echo $json;
	}
}