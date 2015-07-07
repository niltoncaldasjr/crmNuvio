/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.lead.LeadGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.leadgrid',
	title: 		'Cadastro de Lead',
	iconCls: 	'icon-grid',
	store: 		'Lead',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Empresa', 			dataIndex: 'empresa' 			},
	    {text: 'Email', 			dataIndex: 'email' 				},
	    {text: 'Telefone', 			dataIndex: 'telefone'			},
	    {text: 'Contato', 			dataIndex: 'contato' 			},
	    {text: 'Ativo', 			dataIndex: 'ativo' 				},
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
	    		   itemId: 'addLead',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteLead',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'Lead',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});