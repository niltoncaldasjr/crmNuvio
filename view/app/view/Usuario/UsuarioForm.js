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
					allowBlank : false,
				    name: 'nome'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Usuario',
					allowBlank : false,
					name: 'usuario'	
				},
				{
					xtype: 'textfield',
					fieldLabel:'Senha',
					allowBlank : false,
				    name: 'senha'
				},
				{
					xtype: 'textfield',
					fieldLabel:'Email',
					allowBlank : false,
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
		                        id        : 'radio1',
		                        checked: true
		                    }, {
		                        boxLabel  : 'Não',
		                        name      : 'ativo',
		                        inputValue: '1',
		                        id        : 'radio2'
		                    }
		             ]
				},
				{
					xtype: 'combo',
					name: 'idperfil',
					fieldLabel:'Perfil',
					allowBlank : false,
					emptyText:'Selecioone o Perfil...',
				    store: 'Perfil',
				    displayField: 'nome',
				    valueField: 'id'
				    
				},
				{
					xtype: 'combo',
					fieldLabel:'Pessoa Física',
					emptyText:'Selecioone a Pessoa...',
					name: 'idpessoafisica',
					allowBlank : false,
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
					itemId: 'cancelausuario',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'salvausuario',
					iconCls: 'icon-save'
				}
			]
		}
	]
	
});