/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.store.Usuario',{
	extend: 'Ext.data.Store',

	model: 'cau.model.Usuario',

	pageSize: 20,

	proxy: {
		type: 'ajax',

		api:{
			create: 'php/criaUsuario.php',
			read: 'php/listaUsuario.php',
			update: 'php/atualizaUsuario.php',
			destroy: 'php/deletaUsuario.php',
		},

		reader: {
			type: 'json',
			root: 'data'
		},

		writer: {
			type: 'json',
			root: 'data',
			encode: true
		}
	}
});