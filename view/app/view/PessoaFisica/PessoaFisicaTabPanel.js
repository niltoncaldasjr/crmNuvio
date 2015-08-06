Ext.define('crm.view.pessoafisica.PessoaFisicaTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.pessoafisicatabpanel',

	requires: ['crm.view.pessoafisica.PessoaFisicaForm'],
	
	activeTab: 0,

	items: [{
		xtype: 'pessoafisicaform',
		closable: false,
//		iconCls: 'home',
//		title: 'Home'
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 1'
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 2'
	},{
		xtype: 'panel',
		closable: false,
		iconCls: 'icon-grid',
		title: 'Complemento 3'
	}]
});