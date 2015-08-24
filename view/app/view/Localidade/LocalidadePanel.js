Ext.define('crm.view.localidade.LocalidadePanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.localidadepanel',

	requires: ['crm.view.localidade.LocalidadeTabPanel','crm.view.localidade.LocalidadeGrid'],
	
	width: 600,
    height: 400,
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'localidadegrid',
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
	    items: [{ xtype:'localidadetabpanel'}]
    }]
});