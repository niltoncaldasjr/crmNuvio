Ext.define('crm.model.DocumentoPF',{
	extend: 'Ext.data.Model',
	
	fields: [
	   {name: 'id', 			type: 'int'},
	   {name: 'tipo', 			type: 'string'},
	   {name: 'numero', 		type: 'string'},
	   {name: 'dataemissao', 	type: 'string'},
	   {name: 'orgaoemissor', 	type: 'string'},
	   {name: 'via', 			type: 'string'},
	   {name: 'idpessoafisica', type: 'int'},
	   {name: 'datacadastro', 	type: 'date', dateFormat: 'c'},
	   {name: 'dataedicao', 	type: 'date', dateFormat: 'c'}
	]

});