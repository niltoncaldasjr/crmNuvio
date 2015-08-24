Ext.define('crm.view.pais.PaisTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.paistabpanel',

	requires: ['crm.view.pais.PaisForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'paisform',
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