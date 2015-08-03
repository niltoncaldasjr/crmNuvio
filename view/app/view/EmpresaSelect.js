Ext.define('crm.view.EmpresaSelect',{
	/*-- Extend do botão Drop Down --*/
	extend: 'Ext.button.Split',
	alias: 'widget.empresaselect',
	
	menu: Ext.create('crm.view.menu.MenuEmpresa')
//	menu: Ext.create('Ext.menu.Menu',{
//		items: [
//			{
//				xtype: 'menuitem',
//				iconCls: 'nuvio',
//				text: 'Nuvio'
//			},
//			{
//				xtype: 'menuitem',
//				iconCls: 'akto',
//				text: 'Akto'
//			},
//			
//		]
//	})
});