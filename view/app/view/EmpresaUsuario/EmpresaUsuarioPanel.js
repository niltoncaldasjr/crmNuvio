Ext.define('crm.view.empresausuario.EmpresaUsuarioPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.empresausuariopanel',
	
	requires: ['crm.view.empresausuario.UsuarioListaGrid', 'crm.view.empresausuario.EmpresaListaGrid', 'crm.view.empresausuario.EmpresaUsuarioGrid'],
	
	width: 600,
	height: 400,
	
	layout: {
		type: 'border',
		align: 'stretch',
		padding: 0,
	},
	
	items: [
	        
	    {
		    xtype: 'empresalistagrid',
		    region: 'center',
		    flex: 1,
		    split: true
	    },
	    {
		    xtype: 'usuariolistagrid',
		    region: 'west',
		    flex: 1,
		    split: true,
		   
	    },
	    {
			xtype: 'empresausuariogrid',
			region: 'east',
			flex: 2,
			split: true,
		}
	]
});