/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */


Ext.define('cau.view.enderecopf.EnderecoPFForm',{
	
	extend: 'Ext.window.Window',
	alias: 'widget.enderecopfform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar/Criar Endereço PF',
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
					fieldLabel:'Tipo',
				    name: 'tipoEndereco'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Logradouro',
					name: 'logradouro'	
				},
				{
					xtype: 'textfield',
					 fieldLabel:'Numero',
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
					fieldLabel:'CEP',
					name: 'cep'
				},
				{
					defaults:{anchor:'100%'},
					xtype:'combo',
					fieldLabel:'Cidade',
					emptyText:'Selecioone a Cidade ...',
					forceSelection:true,
					editable:false,
					name: 'cidade',
					store: 'CidadeStore',
					queryMode: 'rest',
					displayField: 'nome',
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
					itemId: 'cancelenderecopf',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'saveenderecopf',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});