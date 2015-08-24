/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.localidade.LocalidadeGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.localidadegrid',
	title: 'Cadastro de Localidade',
	iconCls: 'icon-grid',
	store: 'Localidade',

	columns: [
		{ text: 'Id',  dataIndex: 'id'},
        { text: 'Codigo IBGE', dataIndex: 'codigoIBGE'},
        { text: 'UF', dataIndex: 'uf' },
        { text: 'Cidade',  dataIndex: 'cidade'},
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { 
        	text: 'País',  
        	dataIndex: 'idpais',
        	renderer: function(value, metaData, record ){ 
				var paisStore = Ext.getStore('Pais');
				var pais = paisStore.findRecord('id', value);
				return pais != null ? pais.get('descricao') : value;
			}
        }
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addLocalidade',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteLocalidade',
					iconCls: 'icon-delete'
				},
	    	    {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posformlocalidade',
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
	        store: 'Localidade',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma localidade encontrada',
	    	displayMsg: 'Mostrando {0} - {1} de {2}'
		}
	]
	

});