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
	store: 'Rotina',
	
	columns: [
	    {text: 'ID', dataindex: 'id'},
	    {text: 'Nome', dataindex: 'nome'},
	    {text: 'Descrição', dataindex: 'descricao'},
	    {text: 'Ordem', dataindex: 'ordem'},
	    {text: 'URL', dataindex: 'url'},
	    {text: 'Ativo', dataindex: 'ativo'},
	    {text: 'Data Cad.', dataindex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Data Edi.', dataindex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	items: [
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
	    	store: 	'Rotina',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});