Ext.define('crm.view.perfil.ListaDePerfilRotinas',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listadeperfilrotinas',
	title: 'Rotinas',
	iconCls: 'icon-grid',
	store: 'PerfilRotina',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Rotina', 	dataIndex: 'nome', width: 150},
	    {
	    	text: 'C', 
	    	dataIndex: 'consulta',
	    	itemId: 'consCheck',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'I', 
	    	dataIndex: 'incluir',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'A', 
	    	dataIndex: 'alterar',
	    	width: 25,
	    	xtype: 'checkcolumn'   
	    },
	    {
	    	text: 'E', 
	    	dataIndex: 'excluir',
	    	width: 25,
	    	xtype: 'checkcolumn'     
	    }
	    
	],	
	viewConfig: {
        plugins: {
            ptype: 'gridviewdragdrop',
            dragGroup: 'firstGridDDGroup',
            dropGroup: 'secondGridDDGroup',
            pluginId: 'drag'
        },
   	}
});