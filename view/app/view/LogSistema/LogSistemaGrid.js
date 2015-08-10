/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.logsistema.LogSistemaGrid',{
	extend: 	'Ext.ux.LiveSearchGridPanel',
	alias: 		'widget.logsistemagrid',
	title: 		'Logs do Sistrma',
	iconCls: 	'icon-grid',
	store: 		'LogSistema',
	
	columns: [
	    {text: 'ID',					dataIndex: 'id' 				},
	    {text: 'Ocorrência',			dataIndex: 'ocorrencia' 		},
	    {text: 'Nível', 				dataIndex: 'nivel', 			
		    filter: 
		    { 
		    	type: 'list',
	            options: 
	            [
	            	'BASICO', 
	            	'MODERADO', 
	            	'CRITICO',
	            ] 
	        } 
    	},
	    {text: 'Usuário', 				dataIndex: 'idusuario',			
	    	renderer: function(value, metaData, record){
				var Store = Ext.getStore('Usuario');
				var usuario = Store.findRecord('id', value);
				return usuario != null ? usuario.get('nome') : value;
		    },
		    filter: 
		    { 
		    	type: 'string'
		    }			
		},
	    {text: 'Data Cadastro', 		dataIndex: 'datacadastro', 		renderer : Ext.util.Format.dateRenderer('d/m/Y'),
	    filter: 
		    { 
		    	type: 'date'
		    }	
		}
	],

	initComponent: function() {
        var me = this;

        // me.selModel = {
        //     selType: 'cellmodel'
        // };

        // me.plugins = [
        //     Ext.create('Ext.grid.plugin.CellEditing', {
        //         clicksToEdit: 1,
        //         pluginId: 'cellplugin'
        //     })
        // ];

        me.features = [
            Ext.create('Ext.ux.grid.FiltersFeature', {
                local: true
            })
        ];

    
	
	me.dockedItems = [
	    // {
	    // 	xtype: 'toolbar',
	    // 	dock: 	'top',
	    // 	items: [
	    // 	   {
	    // 		   xtype: 'button',
	    // 		   text: 'Novo',
	    // 		   itemId: 'addBanco',
	    // 		   iconCls: 'icon-add'
	    // 	   },
	    // 	   {
	    // 		   xtype: 'button',
	    // 		   text: 'Excluir',
	    // 		   itemId: 'deleteBanco',
	    // 		   iconCls: 'icon-delete'
	    // 	   }
	    // 	]
	    // },
	    {
	    	xtype: 	'pagingtoolbar',
	    	store: 	'LogSistema',
	    	dock:	'bottom',
	    	displayInfo: true,
	    	empyMsg: 'Nenhum dado encontrado'
	    }
	];

	me.callParent(arguments);
}

});