/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.store.TipoContato',{
	extend: 'Ext.data.Store',
	
	model: 'crm.model.TipoContato',
	
	autoLoad: true,
	
	pageSize: 20,
	
	proxy: {
		type: 'rest',
		
		url: 'rest/tipocontato.php',
		
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