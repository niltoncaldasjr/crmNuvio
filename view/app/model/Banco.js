/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Banco', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 					type: 'int'},
	    {name: 'nome', 					type: 'string'},
	    {name: 'codigoBancoCentral', 	type: 'string'},
	    {name: 'datacadastro', 			type: 'date', dateFormat: 'c'},
	    {name: 'dataedicao', 			type: 'date', dateFormat: 'c'},
	    
	]
});