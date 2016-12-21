/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.TipoContato', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 					type: 'int'},
	    {name: 'descricao', 			type: 'string'},
	    {name: 'datacadastro', 			type: 'date', dateFormat: 'c'},
	    {name: 'dataedicao', 			type: 'date', dateFormat: 'c'},
	    
	]
});