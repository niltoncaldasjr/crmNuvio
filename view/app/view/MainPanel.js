Ext.define('crm.view.MainPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.mainpanel',
	
	requires: ['crm.view.home.NewDashboard'],
	
	activeTab: 0,

	items: [{
//		xtype: 'dashpanel',
		xtype: 'newdashboard',
		closable: false,
		iconCls: 'home',
		title: 'Home',
		
		
	}]
});

