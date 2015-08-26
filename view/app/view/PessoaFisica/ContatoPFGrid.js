/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.ContatoPFGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.contatopfgrid',
	title: 		'Cadastro de Contato Pessoa Fisica',
	iconCls: 	'icon-grid',
	store: 		'ContatoPF',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Tipo', 				dataIndex: 'tipo' 				},
	    {text: 'Operadora', 		dataIndex: 'operadora' 			},
	    {text: 'contato', 			dataIndex: 'contato', 			},
	    {text: 'Data Cadadastro', 	dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
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
	    		   itemId: 'addContatoPF',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteContatoPF',
	    		   iconCls: 'icon-delete'
	    	   },
	    	   
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'ContatoPF',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	    
	]
});