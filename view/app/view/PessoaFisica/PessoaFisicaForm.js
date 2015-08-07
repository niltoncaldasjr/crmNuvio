/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

/*-- Criando Store de ComboBox Estado Civil --*/
var estadoCivil = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"SOLTEIRO", "name":"SOLTEIRO"},
        {"value":"CASADO", "name":"CASADO"},
        {"value":"DIVORCIADO", "name":"DIVORCIADO"},
        {"value":"VIUVO", "name":"VIÚVO"}
        //...
    ]
});

/*-- Criando Store de ComboBox Sexo --*/
var sexo = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"MASCULINO", "name":"MASCULINO"},
        {"value":"FEMININO", "name":"FEMININO"}
        //...
    ]
});

/*-- Criando Store de ComboBox Cor --*/
var cor = Ext.create('Ext.data.Store', {
    fields: ['value', 'name'],
    data : [
        {"value":"BRANCA", "name":"BRANCA"},
        {"value":"PRETA", "name":"PRETA"},
        {"value":"PARDA", "name":"PARDA"},
        {"value":"AMARELA", "name":"AMARELA"}
        //...
    ]
});

Ext.define('crm.view.pessoafisica.PessoaFisicaForm',{
	
	extend:	'Ext.panel.Panel',
	alias:	'widget.pessoafisicaform',
	
	height: 	400,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Pessoa Física',
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
	    	    	fieldLabel: 'Nome',
	    	    	name: 		'nome',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'CPF',
	    	    	name: 		'cpf',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 'datefield',
		            anchor: '100%',
		            fieldLabel: 'Data Nascimento',
		            name: 'datanascimento',
		            format: 'd/m/Y',
		            submitFormat: 'Y-m-d' ,
		            allowBlank: false,
		            editable:false,
		        },
	    	    {
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Estado Cívil',
					emptyText:'Selecione o Estado Cívil ...',
					forceSelection:true,
					editable:false,
					name: 'estadocivil',
					store: estadoCivil,
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value',
					allowBlank: false,
				},
				{
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Sexo',
					emptyText:'Selecione o Sexo ...',
					forceSelection:true,
					editable:false,
					name: 'sexo',
					store: sexo,
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value',
					allowBlank: false,
				},
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Pai',
	    	    	name: 		'nomepai',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Mãe',
	    	    	name: 		'nomemae',
	    	    	allowBlank: false,
	    	    },
	    	    {
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Cor',
					emptyText:'Selecione a Cor ...',
					forceSelection:true,
					editable:false,
					name: 'cor',
					store: cor,
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value',
					allowBlank: false,
				},
				{
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Naturalidade',
	    	    	name: 		'naturalidade',
	    	    	allowBlank: false,
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nacionalidade',
	    	    	name: 		'nacionalidade',
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
	    	    	  itemId: 	'cancelaPessoaFisica',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Salvar',
	    	    	  itemId: 	'salvaPessoaFisica',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});