Ext.define('crm.view.menu.Accordion',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.mainmenu',

	width: 400,
	layout: {
		type: 'accordion'
	},
	collapsible: false,
	hideCollapseTool: false,
	iconCls: 'sitemap',
	title: 'Menu'
});