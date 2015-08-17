Ext.define('crm.view.empresausuario.EmpresaUsuarioGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.empresausuariogrid',
	title: 'Empresa Usuário',
	iconCls: 'icon-grid',
	store: 'EmpresaUsuario',
	multiSelect: true,
	
	columns: [
		{
			text: 'ID', 
			dataIndex: 'id',
			type: 'hidden'
		},
	    {
	    	text: 'Empresa', 
	    	dataIndex: 'nomeFantasia'
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

   	// dockedItems: [{
   	// 	xtype: 'toolbar',
   	// 	dock: 'bottom',
   	// 	items: [{
   	// 		xtype: 'button',
   	// 		text: 'Salvar',
   	// 		iconCls: 'icon-save',
   	// 		itemId: 'salvaempresausuario'
   	// 	}]
   	// }]
	
});