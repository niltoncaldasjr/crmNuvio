/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.usuario.UsuarioGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.usuariogrid',
	title: 'Cadastro de Usuarios',
	iconCls: 'icon-grid',
	store: 'Usuario',

	columns: [
		{ text: 'Id',  dataIndex: 'id', width: 50},
        { text: 'Nome', dataIndex: 'nome', width: 250},
        { text: 'Usuario', dataIndex: 'usuario', width: 250 },
        { text: 'Senha',  dataIndex: 'senha', width: 100},
        { text: 'Email', dataIndex: 'email', width: 150},
        { text: 'Ativo', dataIndex: 'ativo' },
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Id Perfil',  dataIndex: 'idperfil'},
        { text: 'Id Pessoa Física',  dataIndex: 'idpessoafisica'}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addUsuario',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteUsuario',
					iconCls: 'icon-delete'
				}
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'Usuario',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhum usuario encontrado',
	    	displayMsg: 'Mostrando {0} - {1} de {2}'
		}
	]
	

});