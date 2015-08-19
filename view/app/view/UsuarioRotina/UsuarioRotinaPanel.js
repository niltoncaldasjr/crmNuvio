Ext.define('crm.view.usuariorotina.UsuarioRotinaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.usuariorotinapanel',
	
	requires: ['crm.view.usuariorotina.ListaUsuarioGrid', 'crm.view.usuariorotina.RotinaListaGrid', 'crm.view.usuariorotina.UsuarioRotinaGrid'],
	
	width: 600,
	height: 400,
	
	layout: {
		type: 'border',
		align: 'stretch',
		padding: 0,
	},
	
	items: [
	        
	    {
		    xtype: 'rotinalistagrid',
		    region: 'center',
		    flex: 1,
		    split: true
	    },
	    {
		    xtype: 'listausuariogrid',
		    region: 'west',
		    flex: 1,
		    split: true,
		   
	    },
	    {
			xtype: 'usuariorotinagrid',
			region: 'east',
			flex: 2,
			split: true,
		}
	]
});