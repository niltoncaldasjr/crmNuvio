/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

/*-- Criando Store de ComboBox Tipo --*/
var tipo = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"RG", "name":"RG"},
        {"value":"CNH", "name":"CNH"},
        {"value":"CTPS", "name":"CTPS"},
        {"value":"PASSAPORTE", "name":"PASSAPORTE"},
        {"value":"OUTROS", "name":"OUTROS"}
    ]
});


Ext.define('crm.view.pessoafisica.DocumentoPFForm',{
	
	extend:	'Ext.window.Window',
	alias:	'widget.documentopfform',
	
	height: 	250,
	width: 		450,
	layout: 	'fit',
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
	    	    	xtype:'combo',
					fieldLabel:'Tipo',
					emptyText:'Selecione...',
					forceSelection:true,
					editable:false,
					name: 'tipo',
					store: tipo,
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value',
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