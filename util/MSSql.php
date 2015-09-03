<?php
class MSSql{	
	private $con;
	
	protected function __construct(){

		$this->con =  mssql_connect("localhost","root","") or die(mssql_get_last_message());
		mssql_select_db("crmnuvio") or die (mssql_get_last_message());
		
	}
	
	public static function getInstance(){
		static $instance = null;
		if (null === $instance){
			$instance = new static();
			
		}
		return $instance;
	}
	
	public function getConexao(){
		mssql_query("SET NAMES 'utf8'");
		mssql_query('SET character_set_connection=utf8');
		mssql_query('SET character_set_client=utf8');
		mssql_query('SET character_set_result=utf8');
		return $this->con;
	}
	
	/*
	 * 	Para chamar a conexao use:
	 * 
	 *  $conexao = Conexao::getInstance()->getConexao();
	 */
	

}