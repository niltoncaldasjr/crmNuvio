/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.perfil.PerfilRotinaEdicao',{
	
	extend: 'Ext.window.Window',
	alias: 'widget.perfilrotinaedicaoform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar Permissão',
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
					xtype: 'hiddenfield',
			        name: 'idperfil'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Nome',
					allowBlank : false,
				    name: 'nome'
				},
				{
		            xtype: 'fieldcontainer',
		            fieldLabel: 'Permissões',
		            defaultType: 'checkboxfield',
		            items: [
		                {
		                    boxLabel  : 'Consultar',
		                    name      : 'consulta',
		                    inputValue: '1',
		                    id        : 'checkbox1'
		                }, {
		                    boxLabel  : 'Incluir',
		                    name      : 'incluir',
		                    inputValue: '2',
		                    id        : 'checkbox2'
		                }, {
		                    boxLabel  : 'Alterar',
		                    name      : 'alterar',
		                    inputValue: '3',
		                    id        : 'checkbox3'
		                },
		                {
		                    boxLabel  : 'Excluir',
		                    name      : 'excluir',
		                    inputValue: '4',
		                    id        : 'checkbox4'
		                }
		            ]
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
					itemId: 'cancelapermissao',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvapermissao',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});