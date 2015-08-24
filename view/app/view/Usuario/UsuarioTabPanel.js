Ext.define('crm.view.usuario.UsuarioTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.usuariotabpanel',

	requires: ['crm.view.usuario.UsuarioForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'usuarioform',
		closable: false,
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 1'
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 2'
	}]
});