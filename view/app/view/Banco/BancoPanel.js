Ext.define('crm.view.banco.BancoPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.bancopanel',

	requires: ['crm.view.banco.BancoForm','crm.view.banco.BancoGrid'],
	
	title: 'Results',
    width: 600,
    height: 400,
    //renderTo: Ext.getBody(),
    layout: {
        type: 'border',       // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        padding: 0
    },
    items: [{               // Results grid specified as a config object with an xtype of 'grid'
        xtype: 'bancogrid',
        region: 'center',
        // columns: [{header: 'Column One'}],            // One header just for show. There's no data,
        // store: Ext.create('Ext.data.ArrayStore', {}), // A dummy empty data store
        flex: 2                                       // Use 1/3 of Container's height (hint to Box layout)
    }, 
    {
        xtype: 'bancoform',
        region: 'south',
        collapsible: true,
        collapsed: true,
        //collapseDirection: 'bottom', 
        //collapseMode: 'header',
        split: true,
        // columns: [{header: 'Column One'}],            // One header just for show. There's no data,
        // store: Ext.create('Ext.data.ArrayStore', {}), // A dummy empty data store
        flex: 1           // Use 2/3 of Container's height (hint to Box layout)
    }]
});