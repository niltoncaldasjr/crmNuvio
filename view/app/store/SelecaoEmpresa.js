Ext.define('crm.store.SelecaoEmpresa',{
	extend: 'Ext.data.Store',
	
	requires: [
	    'crm.model.selecaoempresa.SelecaoEmpresa'
	],
	
	model: 'crm.model.selecaoempresa.SelecaoEmpresa',
	
//	autoLoad: true,
	
	proxy: {
		type: 'ajax',
		url: 'rest/empresausuario.php',
			
		reader: {
			type: 'json',
			root: 'items'
		}
	}
});