/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.DocumentoPF',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.documentopfform',
	
//	height: 	400,
//	width: 		450,
//	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Documento Pessoa Física',
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
	    	    	fieldLabel: 'Número',
	    	    	name: 		'numero',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 'datefield',
		            anchor: '100%',
		            fieldLabel: 'Data Emissão',
		            name: 'dataemissao',
		            format: 'd/m/Y',
		            submitFormat: 'Y-m-d' ,
		            allowBlank: false,
		            editable:false,
		        },
	    	    {
		        	xtype: 		'textfield',
	    	    	fieldLabel: 'Orgão Emissor',
	    	    	name: 		'orgaoemissor',
	    	    	allowBlank: false,
				},
				{
		        	xtype: 		'textfield',
	    	    	fieldLabel: 'Via',
	    	    	name: 		'via',
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
	    	    	  itemId: 	'cancelaDocumentoPF',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaDocumentoPF',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});