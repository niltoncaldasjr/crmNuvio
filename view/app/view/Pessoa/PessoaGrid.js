/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.view.pessoa.PessoaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.pessoagrid',
	title: 'Cadastro de Usuários',
	iconCls: 'icon-grid',
	store: 'PessoaStore',

	columns: [
		{ text: 'Id',  dataIndex: 'id', width: 50},
        { text: 'Nome', dataIndex: 'nome', width: 150},
        { text: 'CPF', dataIndex: 'cpf' },
        { text: 'Data Nascimento', dataIndex: 'dataNascimento', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Estado Civil', dataIndex: 'enum_estadoCivil' },
        { text: 'Sexo', dataIndex: 'enum_sexo' },
        { text: 'Cor', dataIndex: 'enum_cor' },
        { text: 'Naturalidade', dataIndex: 'naturalidade' },
        { text: 'Nacionalidade', dataIndex: 'nacionalidade' },
        { text: 'Data cadastro', dataIndex: 'dataCadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],

	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'top',
			items: [
				{
					xtype: 'button',
					text: 'Novo',
					itemId: 'add',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'delete',
					iconCls: 'icon-delete'
				}
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'PessoaStore',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhuma Pessoa encontrada'
		}
	]
	

});