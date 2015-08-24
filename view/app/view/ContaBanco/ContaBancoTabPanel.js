Ext.define('crm.view.contabanco.ContaBancoTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.contabancotabpanel',

	requires: ['crm.view.contabanco.ContaBancoForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'contabancoform',
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