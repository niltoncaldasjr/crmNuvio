/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.EnderecoPFGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.enderecopfgrid',
	title: 		'Endereços',
	iconCls: 	'icon-grid',
	store: 		'EnderecoPF',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Tipo', 				dataIndex: 'idtipoendereco',
	    	renderer: function(value, metaData, record){
				var Store = Ext.getStore('TipoEndereco');
				var localidade = Store.findRecord('id', value);
				return localidade != null ? localidade.get('descricao') : value;
		    	}
		},	
	    {text: 'Logradouro', 		dataIndex: 'logradouro'			},
	    {text: 'Número', 			dataIndex: 'numero' 			},
	    {text: 'Complemento', 		dataIndex: 'complemento'		},
	    {text: 'Bairro', 			dataIndex: 'bairro' 			},
	    {text: 'Cep', 				dataIndex: 'cep'				},
	    {text: 'Localidade',		dataIndex: 'idlocalidade',
	    	renderer: function(value, metaData, record){
			var Store = Ext.getStore('Localidade');
			var localidade = Store.findRecord('id', value);
			return localidade != null ? localidade.get('cidade') : value;
	    	}
	    },	
	    {text: 'Data Cadastro', 	dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
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
	    		   itemId: 'addEnderecoPF',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteEnderecoPF',
	    		   iconCls: 'icon-delete'
	    	   },
	    	   
	    	]
	    },
	    
	    
	]
});