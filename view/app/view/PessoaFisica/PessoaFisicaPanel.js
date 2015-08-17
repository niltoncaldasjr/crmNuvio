Ext.define('crm.view.pessoafisica.PessoaFisicaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.pessoafisicapanel',

	requires: ['crm.view.pessoafisica.PessoaFisicaTabPanel','crm.view.pessoafisica.PessoaFisicaGrid'],
	
	width: 600,
    height: 400,
    //renderTo: Ext.getBody(),
    layout: {
        type: 'border',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 0
    },
    items: [{               // Results grid specified as a config object with an xtype of 'grid'
        xtype: 'pessoafisicagrid',
        region: 'center',
        // columns: [{header: 'Column One'}],            // One header just for show. There's no data,
        // store: Ext.create('Ext.data.ArrayStore', {}), // A dummy empty data store
        flex: 1                                       // Use 1/3 of Container's height (hint to Box layout)
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
	    flex: 2,
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
	    flex: 2,
	    autoScroll: true,
	    items: [{ xtype:'pessoafisicatabpanel'}]
    }]
        
    
});