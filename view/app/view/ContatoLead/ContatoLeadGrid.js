/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.contatolead.ContatoLeadGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.contatoleadgrid',
	title: 		'Cadastro de Contato Lead',
	iconCls: 	'icon-grid',
	store: 		'ContatoLead',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Data Contato', 		dataIndex: 'datacontato', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Descrição', 		dataIndex: 'descricao' 			},
	    {text: 'Data Retorno', 		dataIndex: 'dataretorno', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Usuário', 			dataIndex: 'idusuario',			
	    	renderer: function(value, metaData, record){
				var Store = Ext.getStore('Usuario');
				var usuario = Store.findRecord('id', value);
				return usuario != null ? usuario.get('nome') : value;
		    }			
		},
	    {text: 'Lead', 				dataIndex: 'idlead',			
	    	renderer: function(value, metaData, record){
				var Store = Ext.getStore('Lead');
				var lead = Store.findRecord('id', value);
				return lead != null ? lead.get('empresa') : value;
	    	}			
	    },
	    {text: 'Data Cadadastro', 	dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Data Edição', 		dataIndex: 'dataedicao', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')}
	],
	
	dockedItems: [
	    {
	    	xtype: 'toolbar',
	    	dock: 	'top',
	    	items: [
	    	   {
	    		   xtype: 'button',
	    		   text: 'Novo',
	    		   itemId: 'addContatoLead',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteContatoLead',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'ContatoLead',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});