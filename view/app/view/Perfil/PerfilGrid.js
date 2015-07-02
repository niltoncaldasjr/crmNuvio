/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.Perfil.PerfilGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.perfilgrid',
	title: 'Cadastro de Perfil',
	iconCls: 'icon-grid',
	store: 'Perfil',

	columns: [
		{ text: 'Id',  dataIndex: 'id', width: 50},
        { text: 'Nome', dataIndex: 'nome', width: 70},
        { text: 'Ativo', dataIndex: 'ativo', width: 70 },
        { text: 'Data Cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data Edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addPerfil',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deletePPerfil',
					iconCls: 'icon-delete'
				}
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'Perfil',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma Perfil encontrado'
		}
	]
	

});