/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.perfil.PerfilForm',{
	
	extend: 'Ext.panel.Panel',
	alias: 'widget.perfilform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar/Criar Perfil',
	autoShow: true,

	items: [
		{
			xtype: 'form',
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
					fieldLabel:'Nome',
					allowBlank : false,
				    name: 'nome'
				},
				{
					xtype: 'fieldcontainer',
					fieldLabel:'Ativo',					
					defaultType: 'radiofield',
					defaults: {
		                flex: 1
		            },
		            defaults: {
		                flex: 1
		            },
		            layout: 'hbox',
		            items: [
		                    {
		                        boxLabel  : 'Sim',
		                        name      : 'ativo',
		                        inputValue: '0',
		                        id        : 'radio1'
		                    }, {
		                        boxLabel  : 'Não',
		                        name      : 'ativo',
		                        inputValue: '1',
		                        id        : 'radio2'
		                    }
		             ]
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
					itemId: 'cancelaperfil',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvaperfil',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});