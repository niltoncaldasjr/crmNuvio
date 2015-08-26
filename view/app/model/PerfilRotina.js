/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costaº
*/

Ext.define('crm.model.PerfilRotina',{
	extend: 'Ext.data.Model',
	
	fields: [
	         	{name: 'id', type: 'int'},
	         	{name: 'nome', type: 'string'},
	         	{name: 'consulta', type: 'int'},
	         	{name: 'incluir', type: 'int'},
	         	{name: 'alterar', type: 'int'},
	         	{name: 'excluir', type: 'int'}
	         
	]

});