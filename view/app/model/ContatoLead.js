/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.model.ContatoLead', {
	extend: 'Ext.data.Model',
	
	fields: [
	    {name: 'id', 				type: 'int'		},
	    {name: 'datacontato', 		type: 'string', dateformat: 'c'},
	    {name: 'descricao', 		type: 'string'	},
	    {name: 'dataretorno', 		type: 'string', dateformat: 'c'},
	    {name: 'datacadastro', 		type: 'date', 	dateFormat: 'c'},
	    {name: 'dataedicao', 		type: 'date', 	dateFormat: 'c'},
	    {name: 'idusuario',			type: 'int'		},
	    {name: 'idlead', 			type: 'int'		}
	    
	]

});

