Ext.define('crm.view.usuariorotina.ListaUsuarioGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listausuariogrid',
	title: 'Usuários',
	iconCls: 'icon-grid',
	store: 'Usuario',
	
	columns: [
	     {
	    	 text: 'Nome', dataIndex: 'nome',
	     }
	]
});