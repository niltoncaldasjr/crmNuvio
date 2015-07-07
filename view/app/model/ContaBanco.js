/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.ContaBanco', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 				type: 'int'		},
	    {name: 'agencia', 			type: 'string'	},
	    {name: 'digitoAgencia', 	type: 'int'		},
	    {name: 'numeroConta', 		type: 'string', },
	    {name: 'digitoConta', 		type: 'int'		},
	    {name: 'numeroCarteira', 	type: 'string'	},
	    {name: 'numeroConvenio', 	type: 'string'	},
	    {name: 'nomeContato', 		type: 'string'	},
	    {name: 'telefoneContato', 	type: 'string'	},
	    {name: 'datacadastro', 		type: 'date', 	dateFormat: 'c'},
	    {name: 'dataedicao', 		type: 'date', 	dateFormat: 'c'},
	    {name: 'idbanco', 			type: 'int'		},
	    {name: 'idempresa', 		type: 'int'		}
	    
	]

});

