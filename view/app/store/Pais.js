/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.store.Pais',{
	extend: 'Ext.data.Store',

	model: 'crm.model.Pais',
	
	autoLoad: true,

	pageSize: 20,
	
	autoLoad: {start: 0, limit: 35},

	proxy: {
		type: 'rest',

		url: 'rest/pais.php',
		
		reader: {
			type: 'json',
			root: 'data',
			successProperty: 'success'
		},

		writer: {
			type: 'json',
			writeAllFields: true,
			root: 'data',
			encode: true
		}
	}
});