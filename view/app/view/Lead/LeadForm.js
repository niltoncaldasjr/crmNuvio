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

Ext.define('crm.view.lead.LeadForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.leadform',
	
	height: 	300,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Lead',
	autoShow: 	true,
	
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
	    	    	fieldLabel: 'Empresa',
	    	    	name: 		'empresa',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'E-mail',
	    	    	name: 		'email',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Telefone',
	    	    	name: 		'telefone',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Contato',
	    	    	name: 		'contato',
	    	    	allowBlank: false
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
					valueField: 'value',
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
	    	    	  itemId: 	'cancelaLead',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaLead',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});