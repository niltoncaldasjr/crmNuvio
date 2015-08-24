Ext.define('crm.view.pais.PaisPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.paispanel',

	requires: ['crm.view.pais.PaisTabPanel','crm.view.pais.PaisGrid'],
	
	width: 600,
    height: 400,
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'paisgrid',
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
	    items: [{ xtype:'paistabpanel'}]
    }]
});