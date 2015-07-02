/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/


Ext.define('crm.view.usuario.UsuarioForm',{
	
	extend: 'Ext.window.Window',
	alias: 'widget.usuarioform',

	height: 300,
	width: 450,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar/Criar Usuário',
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
					fieldLabel:'Nome',
				    name: 'nome'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Usuario',
					name: 'usuario'	
				},
				{
					xtype: 'textfield',
					fieldLabel:'Senha',
				    name: 'senha'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Email',
				    name: 'email'
				},
				{
					xtype: 'fieldcontainer',
					fieldLabel:'Ativo',
					defaultType: 'radiofield',
					defaults: {
		                flex: 1
		            },
		            defaults: {
		                flex: 1
		            },
		            layout: 'hbox',
		            items: [
		                    {
		                        boxLabel  : 'Sim',
		                        name      : 'ativo',
		                        inputValue: '0',
		                        id        : 'radio1'
		                    }, {
		                        boxLabel  : 'Não',
		                        name      : 'color',
		                        inputValue: '1',
		                        id        : 'radio2'
		                    }
		             ]
				},
				{
					xtype: 'combo',
					fieldLabel:'Perfil',
				    store: 'Perfil',
				    displayField: 'nome',
				    valueField: 'id'
				    
				},
				{
					xtype: 'combo',
					fieldLabel:'Pessoa Física',
				    store: 'PessoaFisica',
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
					itemId: 'cancelapais',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvapais',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});