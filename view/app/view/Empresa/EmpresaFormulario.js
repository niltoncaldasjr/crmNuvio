/**
 * Projeto crmNUVIO - JUNHO/2015
 * 
 * ScrumMaster ..: Nilton Caldas Jr. P.O ..........: Giovanni Russo.
 * Desenvolvedor.: Adelson Guimarães Monteiro Desenvolvedor.: Fabiano Ferreira
 * da Silva Costa
 */

Ext.define('crm.view.empresa.EmpresaFormulario', {
	extend : 'Ext.form.Panel',

	alias : 'widget.empresaformulario',
	layout : 'column',
	autoScroll : true,
	frame : true,
	bodyStyle : 'padding:10px 10px 10px',
	iconCls : 'menu_icon_empresa',
	title : 'Editar/Criar Empresa',

	items : [ {
		xtype : 'fieldset',
		columnWidth : 0.5,
		title : 'Dados Cadastrais',
		height : 220,
		collapsible : true,
		defaultType : 'textfield',
		defaults : {
			anchor : '100%'
		},
		layout : 'anchor',
		items : [ {
			xtype : 'hiddenfield',
			name : 'id'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Nome Fantasia',
			allowBlank : false,
			name : 'nomeFantasia'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Razão Social',
			allowBlank : false,
			name : 'razaoSocial'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Nome Reduzido',
			name : 'nomeReduzido'
		}, {
			xtype : 'textfield',
			fieldLabel : 'CNPJ',
			allowBlank : false,
			name : 'CNPJ'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Inscrição Estadual',
			name : 'inscricaoEstadual'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Inscrição Municipal',
			name : 'inscricaoMunicipal'
		}, ]
	}, {
		xtype : 'fieldset',
		columnWidth : 0.5,
		title : 'Endereço',
		height : 220,
		collapsible : true,
		defaultType : 'textfield',
		defaults : {
			anchor : '100%'
		},
		layout : 'anchor',
		items : [ {
			xtype : 'textfield',
			fieldLabel : 'Endereço',
			name : 'endereco'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Número',
			name : 'numero'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Complemento',
			name : 'complemento'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Bairro',
			name : 'bairro'
		}, {
			xtype : 'textfield',
			fieldLabel : 'Cep',
			name : 'cep'
		} ]
	}, {
		xtype : 'container',
		columnWidth : 1.0,
		title : 'Dados Complementares',
		collapsible : true,
		defaultType : 'textfield',
//		defaults : {
//			anchor : '100%'
//		},
		layout : 'hbox',

		items : [ {
			xtype : 'fieldset',
//			columnWidth : 0.5,
			title : 'Dados Complementares',
			collapsible : true,
			height : 150,
			defaultType : 'textfield',
			defaults : {
				anchor : '100%'
			},
			layout : 'anchor',
			items : [ {
				xtype : 'filefield',
				fieldLabel : 'Logotipo',
				name : 'imagemLogotipo',				
				allowBlank : true,
				emptyText : 'Selecione uma imagem...',
				afterLabelTextTpl : ''
			}, {
				xtype : 'combo',
				name : 'idlocalidade',
				fieldLabel : 'Localidade',
				editable : false,
				emptyText : 'Selecione a Localidade...',
				allowBlank : false,
				store : 'Localidade',
				displayField : 'cidade',
				valueField : 'id'

			}, {
				xtype : 'combo',
				fieldLabel : 'Imposto',
				editable : false,
				emptyText : 'Selecione o Imposto...',
				allowBlank : false,
				name : 'idimposto',
				store : 'Imposto',
				displayField : 'titulo',
				valueField : 'id'

			} ]
		}, {
			xtype : 'fieldset',
//			columnWidth : 0.5,
			title : 'Logotipo da Empresa',
			defaultType : 'textfield',
			collapsible : true,
			height : 150,
			defaults : {
				anchor : '100%'
			},
			layout : 'anchor',
			items : [ {
				xtype : 'image',
				height : 150,
				width : 150,
				src : ''
			} ]
		} ]
	} ],
	dockedItems : [ {
		xtype : 'toolbar',
		dock : 'bottom',
		layout : {
			type : 'hbox',
			pack : 'end'
		},
		items : [ {
			xtype : 'button',
			text : 'Cancelar',
			itemId : 'cancelaempresa',
			iconCls : 'icon-reset'
		}, {
			xtype : 'button',
			text : 'Salvar',
			itemId : 'salvaempresa',
			iconCls : 'icon-save'
		} ]
	} ]

});