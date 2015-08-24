Ext.define('crm.store.Menu',{
	extend: 'Ext.data.Store',

	requires: [
		'crm.model.menu.Root'
	],

	model: 'crm.model.menu.Root',

	proxy: {
		type: 'ajax',
		url: 'php/autenticacao/usuarioRotina.php',

		reader: {
			type: 'json',
			root: 'items'
		}
	}
})