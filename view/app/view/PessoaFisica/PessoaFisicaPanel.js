Ext.define('crm.view.pessoafisica.PessoaFisicaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.pessoafisicapanel',

	requires: ['crm.view.pessoafisica.PessoaFisicaTabPanel','crm.view.pessoafisica.PessoaFisicaGrid'],
	
//	width: 600,
//    height: 400,
    layout: {
        type: 'border',       
        align: 'stretch',    
        padding: 0
    },
    items: [{               
        xtype: 'pessoafisicagrid',
        region: 'center',
        layout: 'fit',                                 
    }, 
    {
    	xtype: 'panel',
	    region: 'south',
	    itemId: 'sul',
	    collapsible: true,
	    collapsed: true,
	    title: 'Formulários',
	    iconCls: 'icon_form_pessoafisica',
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
	    iconCls: 'icon_form_pessoafisica',
	    split: true,
	    flex: 1,
	    autoScroll: true,
	    items: [{ xtype:'pessoafisicatabpanel'}]
    }]
        
    
});