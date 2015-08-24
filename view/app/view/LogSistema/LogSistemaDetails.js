Ext.define('crm.view.logsistema.LogSistemaDetails',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.logsistemadetails',

	width: 400,
	height: 400,
	 layout: 'border',

	items: [
		{
			xtype: 'panel',
			itemId: 'antes',
			region: 'center',
			width: 200,
			height: 200,
			split: true
		},
		{
			xtype: 'panel',
			itemId: 'depois',
			region: 'east',
			width: 200,
			height: 200,
			split: true
		}
	]
});