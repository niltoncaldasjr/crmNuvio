/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Lead', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 				type: 'int'},
	    {name: 'empresa', 			type: 'string'},
	    {name: 'email', 			type: 'string'},
	    {name: 'telefone', 			type: 'string', dateFormat: 'c'},
	    {name: 'contato', 			type: 'string'},
	    {name: 'datacadastro', 		type: 'date', dateFormat: 'c'},
	    {name: 'dataedicao', 		type: 'date', dateFormat: 'c'},
	    {name: 'ativo', 			type: 'int'}
	    
	]
});