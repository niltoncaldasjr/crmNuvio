/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.localidade.LocalidadeGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.localidadegrid',
	title: 'Cadastro de Localidade',
	iconCls: 'icon-grid',
	store: 'Localidade',

	columns: [
		{ text: 'Id',  dataIndex: 'id', width: 50},
        { text: 'Codigo IBGE', dataIndex: 'codigoIBGE', width: 250},
        { text: 'UF', dataIndex: 'uf', width: 250 },
        { text: 'Cidade',  dataIndex: 'cidade', width: 100},
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'País',  dataIndex: 'idpais'}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addLocalidade',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteLocalidade',
					iconCls: 'icon-delete'
				}
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'Localidade',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma localidade encontrada',
	    	displayMsg: 'Mostrando {0} - {1} de {2}'
		}
	]
	

});