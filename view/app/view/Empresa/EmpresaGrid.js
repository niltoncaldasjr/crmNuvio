/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.empresa.EmpresaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.empresagrid',
	title: 'Cadastro de Empresa',
	iconCls: 'icon-grid',
	store: 'Empresa',

	columns: [
		{ text: 'Id',  dataIndex: 'id', width: 50},
        { text: 'Nome Fantasia', dataIndex: 'nomeFantasia', width: 70},
        { text: 'Razão social', dataIndex: 'razaoSocial', width: 70 },
        { text: 'CNPJ',  dataIndex: 'CNPJ', width: 50},
        { text: 'Inscrição Estadual', dataIndex: 'inscricaoEstadual', width: 70 },
        { text: 'Inscrição Municipal', dataIndex: 'inscricaoMunicipal', width: 70 },
        { text: 'Bairro', dataIndex: 'bairro', width: 70},
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Localidade',  dataIndex: 'idlocalidade', width: 50},
        { text: 'Imposto',  dataIndex: 'idimposto', width: 50}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'addEmpresa',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteEmpresa',
					iconCls: 'icon-delete'
				}
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'Empresa',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma Empresa encontrada'
		}
	]
	

});