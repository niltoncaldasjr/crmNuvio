Ext.define('crm.view.contatolead.ContatoLeadTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.contatoleadtabpanel',

	requires: ['crm.view.contatolead.ContatoLeadForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'contatoleadform',
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