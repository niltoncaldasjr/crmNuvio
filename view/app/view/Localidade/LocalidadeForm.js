/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.localidade.LocalidadeForm',{
	
	extend: 'Ext.panel.Panel',
	alias: 'widget.localidadeform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar/Criar Localidade',
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
					fieldLabel:'Codigo IBGE',
				    name: 'codigoIBGE'
				},
				{
					xtype: 'textfield',
					fieldLabel:'UF',
					allowBlank : false,
					name: 'uf'	
				},
				{
					xtype: 'textfield',
					fieldLabel:'Cidade',
					allowBlank : false,
				    name: 'cidade'
				},				
				
				{
					xtype: 'combo',
					fieldLabel:'País',
					editable: false,
					emptyText:'Selecioone o País...',
					name: 'idpais',
					allowBlank : false,
				    store: 'Pais',
				    displayField: 'descricao',
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
					itemId: 'cancelalocalidade',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvalocalidade',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});