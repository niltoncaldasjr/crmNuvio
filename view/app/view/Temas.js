Ext.define('crm.view.Temas', {
	extend: 'Ext.button.Split', // #2
	alias: 'widget.temas',
	iconCls: 'config',
	itemId: 'temas',
	menu: Ext.create('Ext.menu.Menu', { 					
			items: [					
			{
				xtype: 'menuitem', 
				text: 'Neptune'
			},
			{
				xtype: 'menuitem', 
				//iconCls: 'es',
				text: 'Classico'
			},
			{
				xtype: 'menuitem', 
				//iconCls: 'pt_BR',
				text: 'Gray'
			},
			{
				xtype: 'menuitem', 
				//iconCls: 'pt_BR',
				text: 'Access'
			}]
		})
});