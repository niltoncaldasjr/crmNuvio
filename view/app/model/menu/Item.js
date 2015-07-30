Ext.define('crm.model.menu.Item',{
	extend: 'Ext.data.Model',

	uses: [
		'crm.model.menu.Root'
	],

	idProperty: 'id',

	fields: [
		{
			name: 'nome'
		},
		{
			name: 'icon'
		},
		{
			name: 'class'
		},
		{
			name: 'id',
		},
		{
			//name: 'parent_id'
			name: 'subrotina'
		}
	],

	belongsTo: {
		model: 'crm.model.menu.Root',
		foreignKey: 'subrotina'
	}
});