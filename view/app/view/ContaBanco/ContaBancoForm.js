/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.contabanco.ContaBancoForm',{
	
	extend:	'Ext.window.Window',
	alias:	'widget.contabancoform',
	
	height: 	350,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Conta Banco',
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
	    	    	fieldLabel: 'Agência',
	    	    	name: 		'agencia'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Dígito Agencia',
	    	    	name: 		'digitoAgencia'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
		            fieldLabel: 'Número Conta',
		            name: 		'numeroConta',
		        },
	    	    {
		        	xtype: 		'textfield',
		            fieldLabel: 'Dígito Conta',
		            name: 		'digitoConta',
				},
				{
					xtype: 		'textfield',
		            fieldLabel: 'Número Carteira',
		            name: 		'numeroCarteira',
				},
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Número Convênio',
	    	    	name: 		'numeroConvenio'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Contato',
	    	    	name: 		'nomeContato'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Telefone Contato',
	    	    	name: 		'telefoneContato'
	    	    },
	    	    {
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Banco',
					emptyText:'Selecione o banco ...',
					forceSelection:true,
					editable:false,
					name: 'idbanco',
					store: 'Banco',
					displayField: 'name',
					valueField: 'id'
				},
				/*{
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Empresa',
					emptyText:'Selecione a empresa ...',
					forceSelection:true,
					editable:false,
					name: 'idempresa',
					store: 'Empresa',
					queryMode: 'rest',
					displayField: 'name',
					valueField: 'id'
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