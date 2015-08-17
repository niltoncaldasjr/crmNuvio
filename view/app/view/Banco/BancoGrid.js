/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.banco.BancoGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.bancogrid',
	title: 		'Cadastro de Banco',
	iconCls: 	'icon-grid',
	store: 		'Banco',
	
	columns: [
	    {text: 'ID',					dataIndex: 'id' 				},
	    {text: 'Nome', 					dataIndex: 'nome' 			},
	    {text: 'Codigo Banco Central', 	dataIndex: 'codigoBancoCentral'			},
	    {text: 'Data Cadadastro', 		dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Data Edição', 			dataIndex: 'dataedicao', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	items: [
	    	   {
					xtype: 'button',
					text: 'Novo',
					itemId: 'addBanco',
					iconCls: 'icon-add'
	    	   },
	    	   {
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteBanco',
					iconCls: 'icon-delete'
	    	   },
	    	   {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posform',
		    			// width: 120,
		    			items: [
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'hide',
		    					iconCls: 'hide',
		    					text: 'Formulário Oculto'
		    				},
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'bottom',
		    					iconCls: 'bottom',
		    					text: 'Formulário  Abaixo'
		    				},
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'right',
		    					iconCls: 'right',
		    					text: 'Formulário À Direita'
		    				}
		    			]
		    		}
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'Banco',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});