/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.DocumentoPFGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.documentopfgrid',
	title: 		'Cadastro de Documento Pessoa Fisica',
	iconCls: 	'icon-grid',
	store: 		'DocumentoPF',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Tipo', 				dataIndex: 'tipo' 				},
	    {text: 'Número', 			dataIndex: 'numero' 			},
	    {text: 'Data Emissão', 		dataIndex: 'dataemissao', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Orgão Emissor', 	dataIndex: 'orgaoemissor', 		},
	    {text: 'Via', 				dataIndex: 'via'},
	    {text: 'Data Cadastro', 	dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Data Edição', 		dataIndex: 'dataedicao', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	items: [
	    	   {
	    		   xtype: 'button',
	    		   text: 'Novo',
	    		   itemId: 'addDocumentoPF',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteDocumentoPF',
	    		   iconCls: 'icon-delete'
	    	   },
	    	   
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'DocumentoPF',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	    
	]
});