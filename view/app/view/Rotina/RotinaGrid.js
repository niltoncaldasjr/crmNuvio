/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.rotina.RotinaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.rotinagrid',
	title: 'Cadastro de Rotinas',
	iconCls: 'icon-grid',
	store: 'crm.store.Rotina',
	
	colums: [
	    {text: 'ID', dataindex: 'id', width: 50},
	    {text: 'Nome', dataindex: 'nome', width: 50},
	    {text: 'Descrição', dataindex: 'descricao', width: 50},
	    {text: 'Ordem', dataindex: 'ordem', width: 50},
	    {text: 'URL', dataindex: 'url', width: 50},
	    {text: 'Ativo', dataindex: 'ativo', width: 50},
	    {text: 'Data Cad.', dataindex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y'), width: 50},
	    {text: 'Data Edi.', dataindex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y'),  width: 50}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	itemns: [
	    	   {
	    		   xtype: 'button',
	    		   text: 'Novo',
	    		   itemId: 'addRotina',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteRotina',
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