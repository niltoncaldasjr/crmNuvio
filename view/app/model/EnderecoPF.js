Ext.define('crm.model.EnderecoPF',{
	extend: 'Ext.data.Model',
	
	fields: [
	   {name: 'id', type: 'int'},
	   {name: 'tipo', type: 'string'},
	   {name: 'logradouro', type: 'string'},
	   {name: 'numero', type: 'string'},
	   {name: 'complemento', type: 'string'},
	   {name: 'bairro', type: 'string'},
	   {name: 'cep',  type: 'string'},
	   {name: 'idlocalidade', type: 'int'},
	   {name: 'idpessoafisica', type: 'int'},
	   {data: 'datacadastro', type: 'date', dateFormat: 'c'},
	   {data: 'dataedicao', type: 'date', dateFormat: 'c'}
	]
});