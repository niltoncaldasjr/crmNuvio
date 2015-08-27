/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.ContatoPF',{
	extend: 'Ext.data.Model',
	
	fields:[
	   {name: 'id', 			type: 'int'},
	   {name: 'tipo', 			type: 'string'},
	   {name: 'operadora', 		type: 'string'},
	   {name: 'contato', 		type: 'string'},
	   {name: 'idpessoafisica', type: 'int'},
	   {name: 'datacadastro', 	type: 'date', dateFormat: 'c'},
	   {name: 'dataedicao',		type: 'date', dateFormat: 'c'}
	   
	]
});