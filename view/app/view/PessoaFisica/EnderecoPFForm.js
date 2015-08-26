/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

/*-- Criando Store de ComboBox Estado Civil --*/
var estadoCivil = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"SOLTEIRO", "name":"SOLTEIRO"},
        {"value":"CASADO", "name":"CASADO"},
        {"value":"DIVORCIADO", "name":"DIVORCIADO"},
        {"value":"VIUVO", "name":"VIÚVO"}
        //...
    ]
});

/*-- Criando Store de ComboBox Sexo --*/
var sexo = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"MASCULINO", "name":"MASCULINO"},
        {"value":"FEMININO", "name":"FEMININO"}
        //...
    ]
});

/*-- Criando Store de ComboBox Cor --*/
var cor = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"BRANCA", "name":"BRANCA"},
        {"value":"PRETA", "name":"PRETA"},
        {"value":"PARDA", "name":"PARDA"},
        {"value":"AMARELA", "name":"AMARELA"}
        //...
    ]
});

Ext.define('crm.view.pessoafisica.EnderecoPFForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.enderecopfform',
	
//	height: 	400,
//	width: 		450,
//	layout: 	'fit',
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
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Tipo',
	    	    	name: 		'tipo',
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
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Localidade',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idlocalidade',
					store: estadoCivil,
					queryMode: 'ajax',
					displayField: 'cidade',
					valueField: 'id',
					allowBlank: false,
				},
				{
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Pessoa Física',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idpessoafisica',
					store: 'PessoaFisica',
					queryMode: 'ajax',
					displayField: 'name',
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