/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Usuario',{
	extend: 'Ext.data.Model',

	fields: [
		{name: 'id',  				type: 'int'},
		{name: 'login',  			type: 'string'},
		{name: 'senha',  			type: 'string'},
		{name: 'idpessoa',  		type: 'int'},
		{name: 'idperfil', 			type: 'int'},
		{name: 'datacadastro', 		type: 'date' , dateFormat: 'c'},
		{name: 'dataatualizacao', 	type: 'date', dateFormat: 'c'}
	]	
	
});