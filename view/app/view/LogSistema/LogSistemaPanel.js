Ext.define('crm.view.logsistema.LogSistemaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.logsistemapanel',

	requires: ['crm.view.logsistema.LogSistemaGrid'],
	
	width: 600,
    height: 400,
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{              
        xtype: 'logsistemagrid',
        region: 'center',
        
    }, 
    {
    	xtype: 'panel',
    	region: 'east',
    	itemId: 'formLog',
    	flex: 1,
    	collapsible: true,
    	collapsed: true,
    	split: true,
    	
    },
    {
        xtype: 'panel',
        region: 'south',
        itemId: 'sul',
        collapsible: true,
        collapsed: true,
        split: true,
        autoScroll: true,
        layout: {
        	type: 'border',
        	padding: 0
        },
        flex: 1,
        iconCls: 'icon-user',
        title: 'Detalhes do Log',
        items:[
           {
        	   xtype: 'panel',
        	   region: 'center',
//        	   collapsible: true,
        	   title: 'Anterior',
        	   flex: 1,
        	   split: true,
        	   itemId: 'antes'
        		   
           },
           {
        	   xtype: 'panel',
        	   title: 'Atual',
        	   region: 'east',
//        	   collapsible: true,
        	   flex: 1,
        	   split: true,
        	   itemId: 'depois'
           }
        ],
        
        dockedItems: [{
        	xtype: 'toolbar',
        	dock: 'bottom',
        	items: [{
        		xtype: 'button',
        		itemId: 'btnLog',
        		text: 'Rowback'
        	}]
        }]
        
    }]
});