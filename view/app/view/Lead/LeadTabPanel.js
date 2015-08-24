Ext.define('crm.view.lead.LeadTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.leadtabpanel',

	requires: ['crm.view.lead.LeadForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'leadform',
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