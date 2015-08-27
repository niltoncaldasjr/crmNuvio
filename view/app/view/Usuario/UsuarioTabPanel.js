Ext.define('crm.view.usuario.UsuarioTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.usuariotabpanel',

	requires: ['crm.view.usuario.UsuarioForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'usuarioform',
		closable: false,
	},{
		xtype: 'usuariorotinapanel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Permissões'
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 2'
	}]
});