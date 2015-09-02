Ext.define('crm.controller.TipoEnderecoController',{
	extend: 'Ext.app.Controller',
	
	stores: ['TipoEndereco'],
	
	models: ['TipoEndereco'],
	
	views: ['tipoendereco.TipoEnderecoGrid'],
	
	requires: ['crm.util.Alert'],
	
	init: function(){
		this.control({
			
		});
	}
});