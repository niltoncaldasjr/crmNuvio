Ext.define('crm.view.empresa.EmpresaPanel',{
	extend: 'Ext.panel.Panel',
	
	alias: 'widget.empresapanel',
	requires: ['crm.view.empresa.EmpresaGrid', 'crm.view.empresa.EmpresaForm'],
	
	layout: {
        type: 'border',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 0
    },
    items: [{               // Results grid specified as a config object with an xtype of 'grid'
        xtype: 'empresagrid',
        region: 'center',
        // columns: [{header: 'Column One'}],            // One header just for show. There's no data,
        // store: Ext.create('Ext.data.ArrayStore', {}), // A dummy empty data store
        flex: 2                                       // Use 1/3 of Container's height (hint to Box layout)
    }, 
    {
    	xtype: 'empresatab',
	    region: 'south',
	    collapsible: true,
	    collapsed: false,
	    title: 'Formulários',
	    iconCls: 'icon_form_pessoafisica',
	    //collapseDirection: 'bottom', 
	    //collapseMode: 'header',
	    split: true,
	    // columns: [{header: 'Column One'}],            // One header just for show. There's no data,
	    // store: Ext.create('Ext.data.ArrayStore', {}), // A dummy empty data store
	    flex: 3,      // Use 2/3 of Container's height (hint to Box layout)
	       
    	
    }]
});