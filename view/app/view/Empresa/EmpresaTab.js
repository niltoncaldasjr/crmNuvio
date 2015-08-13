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
		xtype: 'pessoafisicaform',
		closable: false,
//		iconCls: 'icon-grid',
//		title: 'Complemento 1'
	},{
		xtype: 'bancoform',
		closable: false,
	},{
		xtype: 'contabancoform',
		closable: false,
	}]
});