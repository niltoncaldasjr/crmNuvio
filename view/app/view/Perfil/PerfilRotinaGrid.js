Ext.define('crm.view.perfil.PerfilRotinaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.perfilrotinagrid',
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
	    	dataIndex: 'nome'
	    },
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
            dragGroup: 'secondGridDDGroup',
            dropGroup: 'firstGridDDGroup',
            pluginId: 'dragEmpresaUsuario'
        }
   	},
   	onChecked: function(){
   		console.log('Hello world');
   	}
});