Ext.define('crm.view.pessoafisica.PessoaFisicaTabPanel',{
	extend: 'Ext.tab.Panel',
	alias: 'widget.pessoafisicatabpanel',

	requires: [
	     'crm.view.pessoafisica.PessoaFisicaForm', 
	     'crm.view.pessoafisica.ContatoPFGrid', 
	     'crm.view.pessoafisica.DocumentoPFGrid',
	     'crm.view.pessoafisica.EnderecoPFGrid'
	],
	
	activeTab: 0,

	items: [{
		xtype: 'pessoafisicaform',
		closable: false,
	},{
		xtype: 'contatopfgrid',
		closable: false,
	},{
		xtype: 'documentopfgrid',
		closable: false,
	},{
		xtype: 'enderecopfgrid',
		closable: false,
	}]
});