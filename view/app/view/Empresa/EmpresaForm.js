/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.empresa.EmpresaForm',{
	
//	extend: 'Ext.window.Window',
	extend:	'Ext.panel.Panel',
	alias: 'widget.empresaform',

	height: 560,
	width: 500,
	layout: 'fit',
	iconCls: 'icon-empresa-add',
	title: 'Editar/Criar Empresa',
	autoShow: true,

	items: [
		{
			xtype: 'form',
			hasUpload: true,
			autoScroll: true,
			bodyPadding: 10,
			defaults: {
				anchor: '100%'
			},
			items: [
				{
					xtype: 'hiddenfield',
			        name: 'id'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Nome Fantasia',
					allowBlank : false,
				    name: 'nomeFantasia'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Razão Social',
					allowBlank : false,
					name: 'razaoSocial'	
				},
				{
					xtype: 'textfield',
					fieldLabel:'Nome Reduzido',
				    name: 'nomeReduzido'
				},
				{
					xtype: 'textfield',
					fieldLabel:'CNPJ',
					allowBlank : false,
				    name: 'CNPJ'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Inscrição Estadual',
				    name: 'inscricaoEstadual'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Inscrição Municipal',
				    name: 'inscricaoMunicipal'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Endereço',
				    name: 'endereco'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Número',
				    name: 'numero'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Complemento',
				    name: 'complemento'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Bairro',
				    name: 'bairro'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Cep',
				    name: 'cep'
				},
				{
                    xtype: 'filefield',
                    fieldLabel: 'Logotipo',
                    name: 'imagemLogotipo',
                    allowBlank : true,
                    emptyText: 'Selecione uma imagem...',
                    afterLabelTextTpl: ''
                },					
				{
					xtype: 'combo',
					name: 'idlocalidade',
					fieldLabel:'Localidade',
					editable: false,
					emptyText:'Selecione a Localidade...',
					allowBlank : false,
				    store: 'Localidade',
				    displayField: 'cidade',
				    valueField: 'id'
				    
				},
				{
					xtype: 'combo',
					fieldLabel:'Imposto',
					editable: false,
					emptyText:'Selecione o Imposto...',
					allowBlank : false,
					name: 'idimposto',
				    store: 'Imposto',
				    displayField: 'titulo',
				    valueField: 'id'
				    
				}
			]
		}
	],
	
	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'bottom',
			layout: {
				type: 'hbox',
				pack: 'end'
			},
			items: [
				{
					xtype: 'button',
					text: 'Cancelar',
					itemId: 'cancelaempresa',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvaempresa',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});