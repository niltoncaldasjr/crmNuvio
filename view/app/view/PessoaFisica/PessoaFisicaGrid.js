/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.pessoafisica.PessoaFisicaGrid',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.pessoafisicagrid',
	title: 		'Cadastro de Pessoa Fisica',
	iconCls: 	'icon-grid',
	store: 		'PessoaFisica',
	
	columns: [
	    {text: 'ID',				dataIndex: 'id' 				},
	    {text: 'Nome', 				dataIndex: 'nome' 				},
	    {text: 'CPF', 				dataIndex: 'cpf' 				},
	    {text: 'Data Nascimento', 	dataIndex: 'datanascimento', 	renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Estado CivilL', 	dataIndex: 'estadocivil' 		},
	    {text: 'Sexo', 				dataIndex: 'sexo' 				},
	    {text: 'Nome Pai', 			dataIndex: 'nomepai'			},
	    {text: 'Nome Mãe', 			dataIndex: 'nomemae' 			},
	    {text: 'Cor', 				dataIndex: 'cor' 				},
	    {text: 'Naturalidade', 		dataIndex: 'naturalidade'		},
	    {text: 'Nacionalidade', 	dataIndex: 'nacionalidade'		},
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
	    		   itemId: 'addPessoaFisica',
	    		   iconCls: 'icon-add'
	    	   },
	    	   {
	    		   xtype: 'button',
	    		   text: 'Excluir',
	    		   itemId: 'deletePessoaFisica',
	    		   iconCls: 'icon-delete'
	    	   }
	    	]
	    },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'PessoaFisica',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	]
});