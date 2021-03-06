/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.imposto.ImpostoGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.impostogrid',
	title: 'Cadastro de Imposto',
	iconCls: 'icon-grid',
	store: 'Imposto',

	columns: [
		{ text: 'Id',  dataIndex: 'id'},
		{ text: 'Titulo',  dataIndex: 'titulo'},
        { text: 'ICMS', dataIndex: 'aliquotaICMS'},
        { text: 'PIS', dataIndex: 'aliquotaPIS'},
        { text: 'COFINS',  dataIndex: 'aliquotaCOFINS'},
        { text: 'CSLL', dataIndex: 'aliquotaCSLL'},
        { text: 'ISS', dataIndex: 'aliquotaISS' },
        { text: 'IRPJ',  dataIndex: 'aliquotaIRPJ'},
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addImposto',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteImposto',
					iconCls: 'icon-delete'
				},
	    	    {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posformimposto',
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
	        store: 'Imposto',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhum imposto encontrado'
		}
	]
	

});