Ext.define('crm.view.empresausuario.EmpresaListaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.empresalistagrid',
	title: 'Empresas',
	iconCls: 'icon-grid',
	store: 'Empresa',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Nome', 	dataIndex: 'nomeFantasia'},
	    {text: 'Cnpj', 	dataIndex: 'CNPJ'}
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