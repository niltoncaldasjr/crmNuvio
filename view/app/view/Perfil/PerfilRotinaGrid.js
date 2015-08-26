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
	    	dataIndex: 'consulta'
	    },
	    {
	    	text: 'I', 
	    	dataIndex: 'incluir'
	    },
	    {
	    	text: 'A', 
	    	dataIndex: 'alterar'
	    },
	    {
	    	text: 'E', 
	    	dataIndex: 'excluir'
	    },
	   
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