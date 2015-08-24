/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.contatolead.ContatoLeadForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.contatoleadform',
	
//	height: 	350,
//	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Contato Lead',
	autoShow: 	true,
//	autoScroll: true,
	
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
	    	    	xtype: 		'textareafield',
		            fieldLabel: 'Descrição',
		            emptyText:'Descreva informações sobre este contato',
		            name: 		'descricao',
		            allowBlank: false
		        },
	    	    {
	    	    	xtype: 'datefield',
		            anchor: '100%',
		            fieldLabel: 'Data Contato',
		            emptyText:'Qual data foi feito o contato?',
		            name: 'datacontato',
		            forceSelection:true,
					editable:false,
					format: 'd/m/Y',
			        submitFormat: 'Y-m-d' ,
		            allowBlank: false
		        },
		        {
	    	    	xtype: 'datefield',
		            anchor: '100%',
		            fieldLabel: 'Data Retorno',
		            emptyText:'Qual a data de retorno?',
		            name: 'dataretorno',
		            forceSelection:true,
					editable:false,
					format: 'd/m/Y',
			        submitFormat: 'Y-m-d' ,
		            allowBlank: false
		        },
	    	    {
					xtype:'combo',
					fieldLabel:'Usuário',
					emptyText:'Selecione o usuário ...',
					forceSelection:true,
					editable:false,
					name: 'idusuario',
					store: 'Usuario',
					displayField: 'nome',
					valueField: 'id',
					allowBlank: false
				},
				{
					xtype: 'combo',
					fieldLabel:'Lead',
					emptyText:'Selecioone Lead...',
					forceSelection:true,
					editable:false,
					name: 'idlead',
				    store: 'Lead',
				    displayField: 'empresa',
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
	    	    	  itemId: 	'cancelaContatoLead',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaContatoLead',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});