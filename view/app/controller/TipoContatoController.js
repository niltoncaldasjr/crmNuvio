Ext.define('crm.controller.TipoContatoController',{
	extend: 'Ext.app.Controller',
	
	stores: ['TipoContato'],
	
	models: ['TipoContato'],
	
	views: ['tipocontato.TipoContatoGrid'],
	
	requires: ['crm.util.Alert'],
	
	init: function(){
		this.control({
			
		});
	}
});