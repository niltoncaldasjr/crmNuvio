/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimar�es Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.Imposto',{
	extend: 'Ext.data.Model',

	fields: [
		{name: 'id',  				type: 'int'},
		{name: 'titulo',  			type: 'string'},
		{name: 'aliquotaICMS',  	type: 'float'},
		{name: 'aliquotaPIS',		type: 'float'},
		{name: 'aliquotaCOFINS', 	type: 'float'},
		{name: 'aliquotaCSLL',		type: 'float'},
		{name: 'aliquotaISS',  		type: 'float'},
		{name: 'aliquotaIRPJ',  	type: 'float'},
		{name: 'datacadastro', 		type: 'date' , dateFormat: 'c'},
		{name: 'dataedicao', 		type: 'date' , dateFormat: 'c'}
	]
	
});