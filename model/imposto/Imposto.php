<?php
class Imposto implements JsonSerializable {
	private $id;
	private $titulo;
	private $aliquotaICMS;
	private $aliquotaPIS;
	private $aliquotaCOFINS;
	private $aliquotaCSLL;
	private $aliquotaISS;
	private $aliquotaIRPJ;
	private $datacadastro;
	private $dataedicao;
	
	function __construct($id=null, $titulo=null, $aliquotaICMS=null, $aliquotaPIS=null, $aliquotaCOFINS=null, $aliquotaCSLL=null, $aliquotaISS=null, $aliquotaIRPJ=null, $datacadastro=null, $dataedicao=null) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->aliquotaICMS = $aliquotaICMS;
            $this->aliquotaPIS = $aliquotaPIS;
            $this->aliquotaCOFINS = $aliquotaCOFINS;
            $this->aliquotaCSLL = $aliquotaCSLL;
            $this->aliquotaISS = $aliquotaISS;
            $this->aliquotaIRPJ = $aliquotaIRPJ;
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
        }
        
        function getId() {
            return $this->id;
        }
        
        function getTitulo() {
        	return $this->titulo;
        }
        
        function getAliquotaICMS() {
            return $this->aliquotaICMS;
        }

        function getAliquotaPIS() {
            return $this->aliquotaPIS;
        }

        function getaliquotaCOFINS() {
            return $this->aliquotaCOFINS;
        }

        function getAliquotaCSLL() {
            return $this->aliquotaCSLL;
        }

        function getAliquotaISS() {
            return $this->aliquotaISS;
        }

        function getAliquotaIRPJ() {
            return $this->aliquotaIRPJ;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function getDataedicao() {
            return $this->dataedicao;
        }

        function setId($id) {
            $this->id = $id;
        }
        
        function setTitulo($titulo) {
        	$this->titulo = $titulo;
        }
        

        function setAliquotaICMS($aliquotaICMS) {
            $this->aliquotaICMS = $aliquotaICMS;
        }

        function setAliquotaPIS($aliquotaPIS) {
            $this->aliquotaPIS = $aliquotaPIS;
        }

        function setaliquotaCOFINS($aliquotaCOFINS) {
            $this->aliquotaCOFINS = $aliquotaCOFINS;
        }

        function setAliquotaCSLL($aliquotaCSLL) {
            $this->aliquotaCSLL = $aliquotaCSLL;
        }

        function setAliquotaISS($aliquotaISS) {
            $this->aliquotaISS = $aliquotaISS;
        }

        function setAliquotaIRPJ($aliquotaIRPJ) {
            $this->aliquotaIRPJ = $aliquotaIRPJ;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

        function setDataedicao($dataedicao) {
            $this->dataedicao = $dataedicao;
        }
        
        

		public function jsonSerialize() {
				$impostos [] = [ 
						'id' => $this->id,
						'titulo' => $this->titulo,
						'aliquotaICMS' => $this->aliquotaICMS,
						'aliquotaPIS' => $this->aliquotaPIS,
						'aliquotaCOFINS' => $this->aliquotaCOFINS,
						'aliquotaCSLL' => $this->aliquotaCSLL,
						'aliquotaISS' => $this->aliquotaISS,
						'aliquotaIRPJ' => $this->aliquotaIRPJ,
						'datacadastro' => $this->datacadastro,
						'dataedicao' => $this->dataedicao
				];
				$json = json_encode ( $impostos );
				echo $json;
	}	

}