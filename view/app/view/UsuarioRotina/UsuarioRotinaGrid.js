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
			dataIndex: 'id',
			type: 'hidden'
		},
	    {
	    	text: 'Rotina', 
	    	dataIndex: 'nome'
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