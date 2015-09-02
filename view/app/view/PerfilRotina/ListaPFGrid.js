Ext.define('crm.view.perfilrotina.ListaPFGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listapfgrid',
	title: 'Rotinas do Perfil',
	iconCls: 'icon-grid',
	store: 'PerfilRotina',
	multiSelect: true,
	
	columns: [
		{
			text: 'ID', 
			dataIndex: 'id',
			type: 'hidden'
		},
		{ 
        	text: 'Rotina',  
        	dataIndex: 'idrotina',
        	renderer: function(value, metaData, record ){ 
				var Store = Ext.getStore('Rotina');
				var rotina = Store.findRecord('id', value);
				return rotina != null ? rotina.get('nome') : value;
			}
        },
	    {
	    	text: 'C', 
	    	dataIndex: 'consulta',
	    	itemId: 'consultaCheck',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'I', 
	    	dataIndex: 'incluir',
	    	itemId: 'incluirCheck',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'A', 
	    	dataIndex: 'alterar',
	    	itemId: 'alterarCheck',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'E', 
	    	dataIndex: 'excluir',
	    	itemId: 'excluirCheck',
	    	width: 25,
	    	xtype: 'checkcolumn'     
	    }
	   
	],
	dockedItems: [
	      	    {
	      	    	xtype: 'toolbar',
	      	    	dock: 	'left',
	      	    	layout: {
	  	    		  type:	'vbox',
	  	    		  pack:	'center'
	  	    	  },
	      	    	items: [
	      	    	   {
	      					xtype: 'button',
	      					itemId: 'excluirRotina',
	      					iconCls: 'icon-delete'
	      	    	   }	      	    	  
	      	    	]
	      	    }
	      	]
});