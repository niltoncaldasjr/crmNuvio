/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Empresa',{
	extend: 'Ext.data.Model',

	fields: [
		{name: 'id',  					type: 'int'},
		{name: 'nomeFantasia',  		type: 'string'},
		{name: 'razaoSocial',			type: 'string'},
		{name: 'nomeReduzido',  		type: 'string'},
		{name: 'CNPJ',  				type: 'string'},
		{name: 'InscricaoEstadual',		type: 'string'},
		{name: 'incricaoMunicipal',  	type: 'string'},
		{name: 'endereco',  			type: 'string'},
		{name: 'numero',				type: 'string'},
		{name: 'complemento',  			type: 'string'},
		{name: 'bairro',  				type: 'string'},
		{name: 'cep',  					type: 'string'},
		{name: 'imagemLogotipo',		type: 'string'},
		{name: 'datacadastro', 			type: 'date' , dateFormat: 'c'},
		{name: 'dataedicao', 			type: 'date' , dateFormat: 'c'},
		{name: 'idlocalidade',  		type: 'int'},
		{name: 'idimposto',				type: 'int'},
	]	
	
});