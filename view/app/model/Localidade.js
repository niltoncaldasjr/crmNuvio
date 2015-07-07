/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Localidade',{
	extend: 'Ext.data.Model',

	fields: [
		{name: 'id',  				type: 'int'},
		{name: 'codigoIBGE',  		type: 'int'},
		{name: 'uf',				type: 'string'},
		{name: 'cidade',  			type: 'string'},
		{name: 'datacadastro', 		type: 'date' , dateFormat: 'c'},
		{name: 'dataedicao', 		type: 'date' , dateFormat: 'c'},
		{name: 'idpais',			type: 'int'},
	],
	
});