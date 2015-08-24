/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.usuario.UsuarioGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.usuariogrid',
	title: 'Cadastro de Usuarios',
	iconCls: 'icon-grid',
	store: 'Usuario',

	columns: [
		{ text: 'Id',  dataIndex: 'id'},
        { text: 'Nome', dataIndex: 'nome'},
        { text: 'Usuario', dataIndex: 'usuario'},
        { text: 'Email', dataIndex: 'email', width: 150},
        { text: 'Ativo', dataIndex: 'ativo' },
        { text: 'Data cadastro', dataIndex: 'datacadastro', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { text: 'Data edição', dataIndex: 'dataedicao', renderer : Ext.util.Format.dateRenderer('d/m/Y')},
        { 
        	text: 'Perfil',  
        	dataIndex: 'idperfil',
        	renderer: function(value, metaData, record ){ 
				var perfilStore = Ext.getStore('Perfil');
				var perfil = perfilStore.findRecord('id', value);
				return perfil != null ? perfil.get('nome') : value;
			}
        },
        { 
        	text: 'Pessoa Física',  
        	dataIndex: 'idpessoafisica',
        	renderer: function(value, metaData, record ){ 
				var pfStore = Ext.getStore('PessoaFisica');
				var pf = pfStore.findRecord('id', value);
				return pf != null ? pf.get('nome') : value;
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
					itemId: 'addUsuario',
					iconCls: 'icon-add'
				},
				{
					xtype: 'button',
					text: 'Excluir',
					itemId: 'deleteUsuario',
					iconCls: 'icon-delete'
				},
	    	    {
	    	   		xtype: 'button',
	    	   		iconCls: 'right',
	    	   		text: 'À Direita',
	    	   		menu: {
		    			xtype: 'menu',
		    			itemId: 'posformusuario',
		    			// width: 120,
		    			items: [
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'hide',
		    					iconCls: 'hide',
		    					text: 'Formulário Oculto'
		    				},
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'bottom',
		    					iconCls: 'bottom',
		    					text: 'Formulário  Abaixo'
		    				},
		    				{
		    					xtype: 'menuitem',
		    					itemId: 'right',
		    					iconCls: 'right',
		    					text: 'Formulário À Direita'
		    				}
		    			]
		    		}
	    	   }
			]
		},
		{
			xtype: 'pagingtoolbar',
	        store: 'Usuario',
	        dock: 'bottom',
	        displayInfo: true,
	        emptyMsg: 'Nenhum usuario encontrado',
	    	displayMsg: 'Mostrando {0} - {1} de {2}'
		}
	]
	

});