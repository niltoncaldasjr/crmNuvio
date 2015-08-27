Ext.define('crm.view.usuariorotina.UsuarioRotinaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.usuariorotinagrid',
	title: 'Usuário Rotina',
	iconCls: 'icon-grid',
	store: 'UsuarioRotina',
	multiSelect: true,
	
	columns: [
		{
			text: 'ID', 
			width: 30,
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
});