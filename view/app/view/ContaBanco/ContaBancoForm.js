/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.contabanco.ContaBancoForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.contabancoform',
	
	height: 	350,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Conta Banco',
	autoShow: 	true,
	autoScroll: true,
	
	items: [
	    {
	    	xtype: 			'form',
	    	bodyPadding: 	10,
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
	    	    	fieldLabel: 'Agência',
	    	    	name: 		'agencia',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Dígito Agencia',
	    	    	name: 		'digitoAgencia',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
		            fieldLabel: 'Número Conta',
		            name: 		'numeroConta',
		            allowBlank: false
		        },
	    	    {
		        	xtype: 		'textfield',
		            fieldLabel: 'Dígito Conta',
		            name: 		'digitoConta',
		            allowBlank: false
				},
				{
					xtype: 		'textfield',
		            fieldLabel: 'Número Carteira',
		            name: 		'numeroCarteira',
		            allowBlank: false
				},
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Número Convênio',
	    	    	name: 		'numeroConvenio',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Contato',
	    	    	name: 		'nomeContato',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Telefone Contato',
	    	    	name: 		'telefoneContato',
	    	    	allowBlank: false
	    	    },
	    	    {
					xtype:'combo',
					fieldLabel:'Banco',
					emptyText:'Selecione o banco ...',
					forceSelection:true,
					editable:false,
					name: 'idbanco',
					store: 'Banco',
					displayField: 'nome',
					valueField: 'id',
					allowBlank: false
				},
				{
					xtype: 'combo',
					fieldLabel:'Empresa',
					emptyText:'Selecioone a Pessoa...',
					forceSelection:true,
					editable:false,
					name: 'idempresa',
				    store: 'Empresa',
				    displayField: 'nomeFantasia',
				    valueField: 'id',
				    allowBlank: false
				    
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
	    	    	  itemId: 	'cancelaContaBanco',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaContaBanco',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});