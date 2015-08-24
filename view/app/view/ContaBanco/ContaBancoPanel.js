Ext.define('crm.view.contabanco.ContaBancoPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.contabancopanel',

	requires: ['crm.view.contabanco.ContaBancoTabPanel','crm.view.contabanco.ContaBancoGrid'],
	
	width: 600,
    height: 400,
    
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'contabancogrid',
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
        items: [{ xtype:'contabancotabpanel'}]
    }]
});