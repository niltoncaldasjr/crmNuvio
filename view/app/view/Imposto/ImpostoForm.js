/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.imposto.ImpostoForm',{
	
	extend: 'Ext.window.Window',
	alias: 'widget.impostoform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-imposto-add',
	title: 'Editar/Criar Imposto',
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
					fieldLabel:'aliquotaICMS',
				    name: 'aliquotaICMS'
				},
				{
					xtype: 'textfield',
					fieldLabel:'aliquotaPIS',
					name: 'aliquotaPIS'	
				},
				{
					xtype: 'textfield',
					fieldLabel:'aliquotaCOFINS',
				    name: 'aliquotaCOFINS'
				},
				{
					xtype: 'textfield',
					fieldLabel:'aliquotaCSLL',
				    name: 'aliquotaCSLL'
				},
				{
					xtype: 'textfield',
					fieldLabel:'aliquotaISS',
				    name: 'aliquotaISS'
				},
				{
					xtype: 'textfield',
					fieldLabel:'aliquotaIRPJ',
				    name: 'aliquotaIRPJ'
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
					itemId: 'cancelaimposto',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvaimposto',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});