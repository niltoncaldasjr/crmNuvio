Ext.define('crm.model.EmpresaUsuario',{
	extend: 'Ext.data.Model',
	
	fields: [
	   {name: 'idempresa', 		type: 'int'},
	   {name: 'CNPJ', 			type: 'string'},
	   {name: 'datacadastro', 	type: 'date', dateFormat: 'c'}
	]
});