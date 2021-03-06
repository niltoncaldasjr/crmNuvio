/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.ContatoPFForm',{
	
	extend:	'Ext.window.Window',
	alias:	'widget.contatopfform',
	
	height: 	200,
	width: 		450,
	layout: 	'fit',
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
	    	    	xtype:'combo',
					fieldLabel:'Tipo',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idtipocontato',
					store: 'TipoContato',
					queryMode: 'ajax',
					displayField: 'descricao',
					valueField: 'id',
					allowBlank: false,
	    	    },
	    	    {
	    	    	xtype:'combo',
					fieldLabel:'Operadora',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'idoperadoracontato',
					store: 'OperadoraContato',
					queryMode: 'ajax',
					displayField: 'descricao',
					valueField: 'id',
					allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Contato',
	    	    	name: 		'contato',
	    	    	allowBlank: false,
		        }
	    	  
	    	   
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