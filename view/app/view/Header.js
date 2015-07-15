Ext.define('crm.view.Header',{
	/*-- A classe Header será do tipo toolbar --*/
	extend: 'Ext.toolbar.Toolbar',
	/*-- alias --*/
	alias: 'widget.appheader',

	/*-- Configuração --*/
	height: 50,
	ui: 'footer',
	style: 'border-bottom: 4px solid #4c72a4;',

	/*-- itens --*/
	items: [
		/*-- Titulo da aplicação --*/
		{
			xtype: 'label',
			html: '<div id="titleHeader">Sistema Nuvio <span style="font-size:12px;"> CRM </span></div>'
		},
		/*-- preenchimento da barra --*/
		{
			xtype: 'tbfill' //ou '->'
		},
		/*-- Separador da barra de ferramentas --*/
		{
			xtype: 'tbseparator' //ou '-'
		},
		/*-- Botão de Logout --*/
		{
			xtype: 		'button',
			text: 		'Deslogar',
			itemId: 	'logout',
			iconCls: 	'logout'
		}
	]
});