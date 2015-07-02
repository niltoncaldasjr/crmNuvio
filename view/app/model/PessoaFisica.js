/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.PessoaFisica', {
	extend: 'Ext.data.model',
	
	fields: [
	    {name: 'id', 				type: 'int'},
	    {name: 'nome', 				type: 'string'},
	    {name: 'cpf', 				type: 'string'},
	    {name: 'datanascimento', 	type: 'date', dateFormat: 'c'},
	    {name: 'estadocivil', 		type: 'string'},
	    {name: 'sexo', 				type: 'string'},
	    {name: 'nomepai', 			type: 'string'},
	    {name: 'nomemae', 			type: 'string'},
	    {name: 'cor', 				type: 'string'},
	    {name: 'naturalidade', 		type: 'string'},
	    {name: 'nacionalidade', 	type: 'string'},
	    {name: 'datacadastro', 		type: 'date', dateFormat: 'c'},
	    {name: 'dataedicao', 		type: 'date', dateFormat: 'c'}
	]
});