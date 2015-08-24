Ext.define('crm.view.localidade.LocalidadeTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.localidadetabpanel',

	requires: ['crm.view.localidade.LocalidadeForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'localidadeform',
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