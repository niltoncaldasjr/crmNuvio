/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costaº
*/

Ext.define('crm.model.UsuarioRotina',{
	extend: 'Ext.data.Model',
	
	fields: [
	         	{name: 'id', type: 'int'},
	         	{name: 'nome', type: 'string'},
	         	{name: 'consulta', type: 'string'},
	         	{name: 'incluir', type: 'string'},
	         	{name: 'alterar', type: 'string'},
	         	{name: 'excluir', type: 'string'}
	         
	]

});