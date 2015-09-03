<?php
class ConnectMssql{	
	private $con;
	
	protected function __construct(){

		$this->con =  mssql_connect("10.51.1.3","root","",true) or die(mssql_get_last_message());
		mssql_select_db("dbteste") or die (mssql_get_last_message());
		
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