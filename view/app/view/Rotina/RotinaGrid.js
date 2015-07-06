/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.rotina.RotinaGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.rotinagrid',
	title: 		'Cadastro de Rotinas',
	iconCls: 	'icon-grid',
	store: 		'Rotina',
	
	columns: [
	    {text: 'ID', 			dataIndex: 'id'},
	    {text: 'Nome', 			dataIndex: 'nome'},
	    {text: 'Descrição', 	dataIndex: 'descricao'},
	    {text: 'Ordem', 		dataIndex: 'ordem'},
	    {text: 'URL', 			dataIndex: 'url'},
	    {text: 'Ativo', 		dataIndex: 'ativo'},
	    {text: 'Data Cad.', 	dataIndex: 'datacadastro', 	renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Data Edi.', 	dataIndex: 'dataedicao', 	renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],
	
	dockedItems: [
	    {
	    	xtype:	'toolbar',
	    	dock: 	'top',
	    	items: [
	    	   {
	    		   xtype: 	'button',
	    		   text: 	'Novo',
	    		   itemId: 	'addRotina',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 	'button',
	    		   text: 	'Excluir',
	    		   itemId: 	'deleteRotina',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 			'pagingtoolbar',
	    	store: 			'Rotina',
	    	dock:			'bottom',
	    	displayInfo: 	true,
	    	empyMsg: 		'Nenhum dado encontrado'
	    }
	]
});