/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.MenuPrincipal',{
	
	extend: 'Ext.toolbar.Toolbar',
	alias: 'widget.menuprincipal',
	width   : 500,
    items: [
        {
        	xtype: 'splitbutton',
            text : 'Cadastros',
            menu : Ext.create('Ext.menu.Menu',{
            	items: [
            	        {
            	        	text: 'Pessoa Fisica',
            	        },{
            	        	text: 'Usuario'
            	        },{
            	        	text: 'Permissões'
            	        }
            	]
            })
        },
        '-',
        {
            xtype: 'splitbutton',
            text : 'Split Button'
        },
        '-',
        {
        	text:'Sobre'
        },
        '->',
        {
            xtype    : 'textfield',
            name     : 'field1',
            emptyText: 'enter search term'
        }
    ]
});
