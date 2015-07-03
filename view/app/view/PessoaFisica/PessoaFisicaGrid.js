/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('cmr.view.rotina.RotinaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.rotinagrid',
	title: 'Cadastro de Rotinas',
	iconCls: 'icon-grid',
	store: 'crm.store.Rotina',
	
	colums: [
	    {text: 'ID',				dataindex: 'id', 				width: 50},
	    {text: 'Nome', 				dataindex: 'nome', 				width: 50},
	    {text: 'CPF', 				dataindex: 'cpf', 				width: 50},
	    {text: 'Data Nascimento', 	dataindex: 'datanascimento', 	width: 50},
	    {text: 'Estado CivilL', 	dataindex: 'estadocivil', 		width: 50},
	    {text: 'Sexo', 				dataindex: 'sexo', 				width: 50},
	    {text: 'Nome Pai', 			dataindex: 'nomepai',			width: 50},
	    {text: 'Nome Mãe', 			dataindex: 'nomemae', 			width: 50},
	    {text: 'Cor', 				dataindex: 'cor', 				width: 50},
	    {text: 'Naturalidade', 		dataindex: 'naturalidade',		width: 50},
	    {text: 'Nacionalidade', 	dataindex: 'nacionalidade',		width: 50},
	    {text: 'Data Cadadastro', 	dataindex: 'datacadastro', 		width: 50},
	    {text: 'Data Edição', 		dataindex: 'dataedicao', 		width: 50}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	itemns: [
	    	   {
	    		   xtype: 'button',
	    		   text: 'Novo',
	    		   itemId: 'add',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'delete',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'crm.store.Rotina',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});