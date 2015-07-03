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
        {"value":"MACULINO", "name":"MASCULINO"},
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

Ext.define('crm.view.PessoaFisicaForm'{
	
	extend:	'Ext.window.Window',
	alias:	'pessoafisicaform',
	
	height: 	300,
	width: 		450,
	layout: 	'fit',
	iconCls: 	'icon-user',
	title: 		'Editar/Criar Pessoa Física',
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
	    	    	xtype: 		'hiddenfiled',
	    	    	name: 		'id'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome',
	    	    	name: 		'nome'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'CPF',
	    	    	name: 		'cpf'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Data Nascimento',
	    	    	name: 		'datanascimento'
	    	    },
	    	    {
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Estado Cívil',
					emptyText:'Selecioone o Estado Cívil ...',
					forceSelection:true,
					editable:false,
					name: 'estadocivil',
					store: 'estadoCivil',
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value'
				},
				{
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Sexo',
					emptyText:'Selecioone o Sexo ...',
					forceSelection:true,
					editable:false,
					name: 'sexo',
					store: 'sexo',
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value'
				},
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Pai',
	    	    	name: 		'nomepai'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nome Mãe',
	    	    	name: 		'nomemae'
	    	    },
	    	    {
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Cor',
					emptyText:'Selecioone a Cor ...',
					forceSelection:true,
					editable:false,
					name: 'cor',
					store: 'cor',
					queryMode: 'local',
					displayField: 'name',
					valueField: 'value'
				},
				{
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Naturalidade',
	    	    	name: 		'naturalidade'
	    	    },
	    	    {
	    	    	xtype: 		'textfield',
	    	    	fieldLabel: 'Nacionalidade',
	    	    	name: 		'nacionalidade'
	    	    },
	    	    {
	    	    	//xtype: 		'textfield',
	    	    	//fieldLabel: 'Data Cadastro',
	    	    	//name: 		'datacadastro'
	    	    	xtype: 		'datepicker',
	    	    	fieldLabel: 'Data Cadastro',
	    	    	name: 		'datacadastro'
		    	    minDate: new Date(),
		    	    handler: function(picker, date) {
		    	    	valueField: 'date'
		    	    }
	    	    	
	    	    },
	    	    {
	    	    	//xtype: 		'textfield',
	    	    	//fieldLabel: 'Data Edição',
	    	    	//name: 		'dataedicao'
	    	    	xtype: 		'datepicker',
	    	    	fieldLabel: 'Data Cadastro',
	    	    	name: 		'datacadastro'
		    	    minDate: new Date(),
		    	    handler: function(picker, date) {
		    	    	valueField: 'date'
		    	    }
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
	    	    	  itemId: 	'cancelrotina',
	    	    	  iconCls: 	'icon-reset'
	    	      },
	    	      {
	    	    	  xtype: 	'button',
	    	    	  text: 	'Slavar',
	    	    	  itemId: 	'saverotina',
	    	    	  iconCls: 	'icon-save'
	    	      }
	    	  ]
	      }
	]
});