Ext.define('crm.view.banco.BancoTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.bancotabpanel',

	requires: ['crm.view.banco.BancoForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'bancoform',
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