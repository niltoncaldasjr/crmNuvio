/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.contabanco.ContaBancoGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.contabancogrid',
	title: 		'Cadastro de Conta Banco',
	iconCls: 	'icon-grid',
	store: 		'ContaBanco',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Agência', 			dataIndex: 'agencia' 			},
	    {text: 'Digito Agência', 	dataIndex: 'digitoAgencia' 		},
	    {text: 'Numero Conta', 		dataIndex: 'numeroConta', 		},
	    {text: 'Dígito Conta', 		dataIndex: 'digitoConta' 		},
	    {text: 'Número Carteira', 	dataIndex: 'numeroCarteira' 	},
	    {text: 'Número Convênio', 	dataIndex: 'numeroConvenio'		},
	    {text: 'Nome Contato', 		dataIndex: 'nomeContato' 		},
	    {text: 'Telefone Contato', 	dataIndex: 'telefoneContato' 	},
	    {text: 'Banco', 			dataIndex: 'idbanco'			},
	    {text: 'Empresa', 			dataIndex: 'idempresa'			},
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
	    		   itemId: 'addContaBanco',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deleteContaBanco',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'ContaBanco',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});