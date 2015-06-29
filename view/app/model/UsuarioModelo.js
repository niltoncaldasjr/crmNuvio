/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.model.Usuario',{
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