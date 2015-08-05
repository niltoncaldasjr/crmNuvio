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
		{ text: 'Id',  dataIndex: 'id'},
        { text: 'Nome Fantasia', dataIndex: 'nomeFantasia'},
        { text: 'Razão social', dataIndex: 'razaoSocial'},
        { text: 'CNPJ',  dataIndex: 'CNPJ'},
        { text: 'Inscrição Estadual', dataIndex: 'inscricaoEstadual'},
        { text: 'Inscrição Municipal', dataIndex: 'inscricaoMunicipal'},
        { text: 'Bairro', dataIndex: 'bairro'},
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { 
        	text: 'Localidade',  
        	dataIndex: 'idlocalidade',
        	renderer: function(value, metaData, record ){ 
				var localStore = Ext.getStore('Localidade');
				var local = localStore.findRecord('id', value);
				return local != null ? local.get('cidade') : value;
			}
        },
        { 
        	text: 'Imposto',  
        	dataIndex: 'idimposto',
        	renderer: function(value, metaData, record ){ 
				var impostoStore = Ext.getStore('Imposto');
				var imposto = impostoStore.findRecord('id', value);
				return imposto != null ? imposto.get('titulo') : value;
			}
        }
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