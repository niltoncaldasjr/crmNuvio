/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.MyViewport',{
	/*-- Classe será do tipo viewport --*/
	extend: 'Ext.container.Viewport',
	/*-- Criamos o alias da classe --*/
	alias: 'widget.mainviewport',
	/*-- Requisitamos a classe header --*/
	requires: [
	    'crm.view.Header',
	    'crm.view.MainPanel',
	    'crm.view.contatolead.ProximosContatos'

	],
	/*-- O layout será border --*/
	layout: {
		type: 'border'
	},

	/*-- Definindo os itens --*/
	items: [
		/*-- Container que contem o cabeçalho --*/
		{
			xtype: 'appheader',
			region: 'north'
		},
		/*-- Menu Accordion --*/
		{
			xtype: 'mainmenu',
			width: 185,
			collapsible: true,
			region: 'west',
			style: 'background-color: #8FB488;'
		},
		/*-- Centro --*/
		{
			xtype: 'mainpanel',
			region: 'center'
		},
		/*-- Container que contem o rodape --*/
		{
			xtype: 'container',
			region: 'south',
			height: 30,
			style: 'border-top: 1px solid #4c72a4;',
			html: '<div id="titleHeader"><center><span style="font-size:10px;">CRM - NUVIO - http://www.nuvio.com</span></center></div>'
		},
		{
			xtype: 'panel',
			region: 'east',
			width: 200,
			collapsible: true,
			collapsed: true,
			split: true,
			title: 'DashBoard',
			iconCls: 'view',
			items:[{xtype:'proximoscontato'}]
		}
	]
});