/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

/*-- Criando Store de ComboBox Ativo --*/
var ativo = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"1", "name":"ATIVO"},
        {"value":"0", "name":"INATIVO"},
        //...
    ]
});

Ext.define('crm.view.rotina.RotinaForm',{
	
	extend:	'Ext.window.Window',
	alias:	'widget.rotinaform',
	
	height: 	300,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Rotina',
	autoShow: 	true,
	
	items: [
	    {
	    	xtype: 			'form',
	    	bodyPadding: 	10,
	    	defaults: {
	    			anchor: '100%'
	    	},
	    	
	    	items: [
	    	    {
	    	    	xtype: 		'hiddenfield',
	    	    	name: 		'id'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome',
	    	    	name: 		'nome'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Descrição',
	    	    	name: 		'descricao'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Ordem',
	    	    	name: 		'ordem'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'URL',
	    	    	name: 		'url'
	    	    },
	    	    {
					xtype:'combo',
					fieldLabel:'Ativo',
					emptyText:'Selecione a opção ...',
					forceSelection:true,
					editable:false,
					name: 'ativo',
					store: ativo,
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value'
				},
				/*{
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Ativo',
	    	    	name: 		'ativo'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Data Cadastro',
	    	    	name: 		'datacadastro'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Data Edição',
	    	    	name: 		'dataedicao'
	    	    },*/
	    	   
	    	]
	    }
	],
	
	dockedItems: [
	      {
	    	  xtype:	'toolbar',
	    	  dock:		'bottom',
	    	  layout: {
	    		  type:	'hbox',
	    		  pack:	'end'
	    	  },
	    	  items: [
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Cancelar',
	    	    	  itemId: 	'cancelaRotina',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaRotina',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});