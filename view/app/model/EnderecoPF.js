Ext.define('crm.model.EnderecoPF',{
	extend: 'Ext.data.Model',
	
	fields: [
	   {name: 'id', 				type: 'int'},
	   {name: 'idtipoendereco', 	type: 'int'},
	   {name: 'logradouro', 		type: 'string'},
	   {name: 'numero', 			type: 'string'},
	   {name: 'complemento', 		type: 'string'},
	   {name: 'bairro', 			type: 'string'},
	   {name: 'cep',  				type: 'string'},
	   {name: 'idlocalidade', 		type: 'int'},
	   {name: 'idpessoafisica',		type: 'int'},
	   {name: 'datacadastro', 		type: 'date', dateFormat: 'c'},
	   {name: 'dataedicao', 		type: 'date', dateFormat: 'c'}
	]
});