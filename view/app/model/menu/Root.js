Ext.define('crm.model.menu.Root',{
	extend: 'Ext.data.Model',

	uses: [
		'crm.model.menu.Item'
	],

	idProperty: 'id',

	fields: [
		{
			name: 'nome',
		},
		{
			name: 'icon'
		},
		{
			name: 'id'
		}
	],

	hasMany: {
		model: 'crm.model.menu.Item',
		foreignKey: 'subrotina',
		name: 'items'
	}
});