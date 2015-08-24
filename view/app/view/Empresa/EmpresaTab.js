Ext.define('crm.view.empresa.EmpresaTab',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.empresatab',

	requires: ['crm.view.banco.BancoForm', 'crm.view.empresa.EmpresaFormulario'],
	
	activeTab: 0,

	items: [{
		xtype: 'empresaformulario',
		closable: false,
//		iconCls: 'home',
//		title: 'Home'
	},{
		xtype: 'impostotabpanel',
		closable: false,
		iconCls: 'menu_icon_imposto',
		title: 'Imposto'
	},{
		xtype: 'bancotabpanel',
		closable: false,
		iconCls: 'menu_icon_banco',
		title: 'Banco'
	},{
		xtype: 'contabancoform',
		closable: false,
	}]
});