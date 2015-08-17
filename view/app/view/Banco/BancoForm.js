/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.banco.BancoForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.bancoform',
	
	height: 	150,
	//minHeight: 150,
	width: 		450,
	layout: 	'fit',
	// iconCls: 	'icon-user',
	// title: 		'Editar/Criar Banco',
	autoShow: 	true,
	// flex: 1,
	
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
	    	    	fieldLabel: 'Nome',
	    	    	name: 		'nome',
	    	    	allowBlank: false
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Código Banco Central',
	    	    	name: 		'codigoBancoCentral',
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
	    	    	  itemId: 	'cancelaBanco',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaBanco',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});