/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.LogSistema', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 				type: 'int'},
	    {name: 'ocorrencia', 		type: 'string'},
	    {name: 'nivel', 			type: 'string'},
	    {name: 'idusuario', 		type: 'int'},
	    {name: 'datacadastro', 		type: 'date', dateFormat: 'c'},
	]
});