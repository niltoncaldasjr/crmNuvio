Ext.define('crm.store.Menu',{
	extend: 'Ext.data.Store',

	requires: [
		'crm.model.menu.Root'
	],

	model: 'crm.model.menu.Root',

	proxy: {
		type: 'ajax',
		url: 'rest/perfilRotina.php',

		reader: {
			type: 'json',
			root: 'items'
		}
	}
})