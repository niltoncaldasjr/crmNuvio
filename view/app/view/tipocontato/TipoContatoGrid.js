/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.tipocontato.TipoContatoGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.tipocontatogrid',
	title: 		'Cadastro de Tipo de Contato',
	iconCls: 	'icon-grid',
	store: 		'TipoContato',
	
	columns: [
	    {text: 'ID',					dataIndex: 'id' 				},
	    {text: 'Descrição', 			dataIndex: 'descricao' 			},
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
					itemId: 'addTipoContato',
					iconCls: 'icon-add'
	    	   },
	    	   {
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteTipoContato',
					iconCls: 'icon-delete'
	    	   },
	    	   {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posformtipocontato',
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
	    	store: 	'TipoContato',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});