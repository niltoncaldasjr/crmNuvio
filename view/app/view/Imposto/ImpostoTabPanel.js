Ext.define('crm.view.imposto.ImpostoTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.impostotabpanel',

	requires: ['crm.view.imposto.ImpostoForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'impostoform',
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