Ext.define('crm.view.contatolead.ContatoLeadPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contatoleadpanel',

	requires: ['crm.view.contatolead.ContatoLeadTabPanel','crm.view.contatolead.ContatoLeadGrid'],
	
	width: 600,
    height: 400,
    
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'contatoleadgrid',
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
        iconCls: 'icon-grid',
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
        iconCls: 'icon-grid',
        split: true,
        flex: 1,
        autoScroll: true,
        items: [{ xtype:'contatoleadtabpanel'}]
    }]
});