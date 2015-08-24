Ext.define('crm.view.lead.LeadPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.leadpanel',

	requires: ['crm.view.lead.LeadTabPanel','crm.view.lead.LeadGrid'],
	
	width: 600,
    height: 400,

    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'leadgrid',
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
        items: [{ xtype:'leadtabpanel'}]
    }]
});