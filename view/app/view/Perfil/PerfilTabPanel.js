Ext.define('crm.view.perfil.PerfilTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.perfiltabpanel',

	requires: ['crm.view.banco.PerfilForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'perfilform',
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
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 3'
	}]
});