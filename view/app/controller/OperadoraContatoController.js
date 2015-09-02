Ext.define('crm.controller.OperadoraContatoController',{
	extend: 'Ext.app.Controller',
	
	stores: ['OperadoraContato'],
	
	models: ['OperadoraContato'],
	
	view: ['operadoracontato.OperadoraContatoGrid'],
	
	requires: ['crm.util.Alert'],
	
	init: function(){
		this.control({
			
		});
	}
});