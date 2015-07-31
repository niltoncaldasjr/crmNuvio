Ext.define('crm.view.Config', {
	extend: 'Ext.button.Split', // #2
	alias: 'widget.config', // #1
	menu: Ext.create('Ext.menu.Menu', { // #3
		items: [
		{
			xtype: 'configitem', // #4
			iconCls: 'logout',
			text: 'Logout'
		},
		{
			xtype: 'configitem', // #5
			iconCls: 'es',
			text: 'Mudar Thema'
		},
		{
			xtype: 'configitem', // #6
			iconCls: 'pt_BR',
			text: 'Português'
		}]
	})
});