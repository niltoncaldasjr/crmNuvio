Ext.define('crm.model.ContatoPF',{
	extend: 'Ext.data.Model',
	
	fields:[
	   {name: 'id', 			type: 'int'},
	   {name: 'tipo', 			type: 'string'},
	   {name: 'operadora', 		type: 'string'},
	   {name: 'contato', 		type: 'string'},
	   {name: 'idpessoafisica', type: 'int'},
	   {name: 'datacadastro', 	type: 'date', dateFormat: 'c'},
	   {name: 'dataedicao',		type: 'date', dateFormat: 'c'}
	   
	]
});