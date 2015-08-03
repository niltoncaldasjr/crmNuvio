Ext.define('crm.store.EmpresaSelect',{
	extend: 'Ext.data.Store',
	
	requires: [
	    'crm.model.empresaselect.EmpresaSelect'
	],
	
	model: 'crm.model.empresaselect.EmpresaSelect',
	
	proxy: {
		type: 'ajax',
		url: 'rest/empresausuario.php',
			
		reader: {
			type: 'json',
			root: 'items'
		}
	}
});