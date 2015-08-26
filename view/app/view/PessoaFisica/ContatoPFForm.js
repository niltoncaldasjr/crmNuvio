/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.ContatoPFForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.contatopfform',
	
//	height: 	400,
//	width: 		450,
//	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Contato Pessoa Física',
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
	    	    	fieldLabel: 'Operadora',
	    	    	name: 		'operadora',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Contato',
	    	    	name: 		'contato',
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
	    	    	  itemId: 	'cancelaContatoPF',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaContatoPF',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});