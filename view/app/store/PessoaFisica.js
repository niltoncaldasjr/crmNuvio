/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.store.PessoaFisica',{
	extend: 'Ext.data.Store',
	
	model: 'crm.model.PessoaFisica',
	
	autoLoad: true,
	
	pageSize: 20,
	
	proxy: {
		type: 'rest',
		
		url: 'rest/pessoaFisica.php',
		
		reader: {
			type: 'json',
			root: 'data'
		},
		
		writer: {
			type: 'json',
			root: 'data',
			encode: true
		}
	}
});