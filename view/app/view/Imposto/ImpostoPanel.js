Ext.define('crm.view.imposto.ImpostoPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.impostopanel',

	requires: ['crm.view.imposto.ImpostoTabPanel','crm.view.imposto.ImpostoGrid'],
	
	width: 600,
    height: 400,
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'impostogrid',
        region: 'center',
    
        layout: 'fit'                                
    }, 
    {
    	xtype: 'panel',
	    region: 'south',
	    itemId: 'sul',
	    collapsible: true,
	    collapsed: true,
	    title: 'Formulários',
	    iconCls: 'menu_icon_banco',
	    split: true,
	    flex: 1,
	    autoScroll: true,
	    hidden: true
	       
    },
    {
    	xtype: 'panel',
    	itemId: 'oeste',
	    region: 'east',
	    collapsible: true,
	    collapsed: true,
	    title: 'Formulários',
	    iconCls: 'menu_icon_banco',
	    split: true,
	    flex: 1,
	    autoScroll: true,
	    items: [{ xtype:'impostotabpanel'}]
    }]
});