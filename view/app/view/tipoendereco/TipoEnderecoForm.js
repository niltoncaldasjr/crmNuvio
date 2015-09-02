/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.tipoendereco.TipoEnderecoForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.tipoenderecoform',
	
//	height: 	150,
	//minHeight: 150,
//	width: 		450,
//	layout: 	'fit',
	iconCls: 	'icon-grid',
	title: 		'Editar/Criar Tipo Endereco',
	autoShow: 	true,
	flex: 1,
	
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
	    	    	fieldLabel: 'Descrição',
	    	    	name: 		'descricao',
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
	    	    	  itemId: 	'cancelaTipoEndereco',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaTipoEndereco',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});