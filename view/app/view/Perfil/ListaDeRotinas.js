Ext.define('crm.view.perfil.ListaDeRotinas',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listaderotinas',
	title: 'Lista de Rotinas',
	iconCls: 'icon-grid',
	store: 'PerfilRotina',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Rotina', 	dataIndex: 'idperfil', width: 150}
//	    {
//	    	text: 'C', 
//	    	dataIndex: 'consulta',
//	    	itemId: 'consCheck',
//	    	width: 25,
//	    	xtype: 'checkcolumn'   
//	    },
//	    {
//	    	text: 'I', 
//	    	dataIndex: 'incluir',
//	    	width: 25,
//	    	xtype: 'checkcolumn'   
//	    },
//	    {
//	    	text: 'A', 
//	    	dataIndex: 'alterar',
//	    	width: 25,
//	    	xtype: 'checkcolumn'   
//	    },
//	    {
//	    	text: 'E', 
//	    	dataIndex: 'excluir',
//	    	width: 25,
//	    	xtype: 'checkcolumn'     
//	    }
//	    
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