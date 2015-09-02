Ext.define('crm.view.perfil.Rotinas',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.rotinas',
	title: 'Rotinas',
	iconCls: 'icon-grid',
	store: 'Rotina',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Rotina', 	dataIndex: 'nome', width: 150}	    
//	    
	],	
	dockedItems: [
		      	    {
		      	    	xtype: 'toolbar',
		      	    	dock: 	'right',
		      	    	layout: {
		  	    		  type:	'vbox',
		  	    		  pack:	'center'
		  	    	  },
		      	    	items: [		      	    	 
		      	    	   {
		      					xtype: 'button',
		      					itemId: 'adicionarRotina',
		      					iconCls: 'icon-add'
		      	    	   }
		      	    	]
		      	    }
		      	]
});