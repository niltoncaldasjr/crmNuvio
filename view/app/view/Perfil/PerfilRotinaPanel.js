Ext.define('crm.view.perfil.PerfilRotinaPanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.perfilrotinapanel',
	
	requires: ['crm.view.perfil.PerfilGrid', 'crm.view.perfil.Rotinas', 'crm.view.perfil.PerfilRotinaGrid'],
	
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
			xtype: 'perfilrotinagrid',
			region: 'east',
			flex: 1,
			split: true,
		}
	]
});