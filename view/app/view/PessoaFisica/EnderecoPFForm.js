/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.EnderecoPFForm',{
	
	extend:	'Ext.window.Window',
	alias:	'widget.enderecopfform',
	
	height: 	300,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Endereço Pessoa Física',
	autoShow: 	true,
	
	items: [
	    {
	    	xtype: 			'form',
	    	bodyPadding: 	10,
	    	autoScroll: true,
	    	
	    	defaults: {
	    			anchor: '100%',
	    			msgTarget: 'under'
	    	},
	    	
	    	items: [
	    	    {
	    	    	xtype: 		'hiddenfield',
	    	    	name: 		'id'
	    	    },
	    	    {
	    	    	xtype:'combo',
					fieldLabel:'Tipo',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idtipoendereco',
					store: 'TipoEndereco',
					queryMode: 'ajax',
					displayField: 'descricao',
					valueField: 'id',
					allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Logradouro',
	    	    	name: 		'logradouro',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Número',
	    	    	name: 		'numero',
	    	    	allowBlank: false,
		        },
		        {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Complemento',
	    	    	name: 		'complemento',
	    	    	allowBlank: false,
		        },
		        {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Bairro',
	    	    	name: 		'bairro',
	    	    	allowBlank: false,
		        },
		        {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'CEP',
	    	    	name: 		'cep',
	    	    	allowBlank: false,
		        },
		        {
					xtype:'combo',
					fieldLabel:'Localidade',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idlocalidade',
					store: 'Localidade',
					queryMode: 'ajax',
					displayField: 'cidade',
					valueField: 'id',
					allowBlank: false,
				},
				
	    	   
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
	    	    	  itemId: 	'cancelaEnderecoPF',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaEnderecoPF',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});