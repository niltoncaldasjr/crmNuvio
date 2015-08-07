Ext.define('Packt.view.MainPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.mainpanel',
	
	requires: ['crm.view.home.Dashboard'],
	
	activeTab: 0,

	items: [{
		xtype: 'dashpanel',
		closable: false,
		iconCls: 'home',
		title: 'Home',
		
		
	}]
});

