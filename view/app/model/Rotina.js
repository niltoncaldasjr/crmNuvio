/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Rotina', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 			type: 'int'},
	    {name: 'nome', 			type: 'string'},
	    {name: 'descricao', 	type: 'string'},
	    {name: 'subrotina', 	type: 'int'},
	    {name: 'class', 		type: 'string'},
	    {name: 'ativo', 		type: 'int'},
	    {name: 'icon', 			type: 'string'},
	    {name: 'datacadastro', 	type: 'date', dateFormat: 'c'},
	    {name: 'dataedicao', 	type: 'date', dateFormat: 'c'},
	    {name: 'consulta', type: 'string'},
     	{name: 'incluir', type: 'string'},
     	{name: 'alterar', type: 'string'},
     	{name: 'excluir', type: 'string'}
	]
});