Ext.define('crm.view.perfil.PerfilRotinaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.perfilrotinapanel',
	
//	requires: ['crm.view.perfil.PerfilGrid', 'crm.view.perfil.Rotinas', 'crm.view.perfil.PerfilRotinaGrid'],
	requires: ['crm.view.perfil.PerfilGrid', 'crm.view.perfil.Rotinas', 'crm.view.perfilrotina.ListaPFGrid'],
	
	width: 600,
	height: 400,
	
	layout: {
		type: 'border',
		align: 'stretch',
		padding: 0,
	},
	
	items: [
	        
	    {
		    xtype: 'rotinas',
//	    	xtype: 'listaderotinas',
		    region: 'center',
		    flex: 1,
		    split: true
	    },
	    {
		    xtype: 'perfilgrid',
		    region: 'west',
		    flex: 1,
		    split: true,
		   
	    },	   
	    {
//			xtype: 'perfilrotinagrid',
	    	xtype: 'listapfgrid',
			region: 'east',
			flex: 1,
			split: true,
		}
	]
});