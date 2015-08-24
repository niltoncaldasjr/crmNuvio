/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pais.PaisGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.paisgrid',
	title: 'Cadastro de Paises',
	iconCls: 'icon-grid',
	store: 'Pais',

	columns: [
		{ text: 'Id',  dataIndex: 'id'},
        { text: 'Descrição', dataIndex: 'descricao'},
        { text: 'Nacionalidade', dataIndex: 'nacionalidade' },
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addPais',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deletePais',
					iconCls: 'icon-delete'
				},
	    	    {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posformpais',
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
			xtype: 'pagingtoolbar',
	        store: 'Pais',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma Pais encontrada'
		}
	]
	

});