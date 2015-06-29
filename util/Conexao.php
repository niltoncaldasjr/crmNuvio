<?php
class Conexao{	
	private $con;
	
	protected function __construct(){

		$this->con = mysqli_connect("localhost","root","root", "crmnuvio");
		if (mysqli_connect_error()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
	
	public static function getInstance(){
		static $instance = null;
		if (null === $instance){
			$instance = new static();
		}
		return $instance;
	}
	
	public function getConexao(){
		return $this->con;
	}
	
	/*
	 * 	Para chamar a conexao use:
	 * 
	 *  $conexao = Conexao::getInstance()->getConexao();
	 */
	

}