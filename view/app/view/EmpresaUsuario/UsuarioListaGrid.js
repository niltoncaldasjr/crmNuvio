Ext.define('crm.view.empresausuario.UsuarioListaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.usuariolistagrid',
	title: 'Usuários',
	iconCls: 'icon-grid',
	store: 'Usuario',
	
	columns: [
	     {
	    	 text: 'Nome', dataIndex: 'nome',
	     }
	]
});