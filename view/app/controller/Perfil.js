Ext.define('crm.controller.Perfil', {
    extend: 'Ext.app.Controller',

    stores: ['Perfil'],

    models: ['Perfil'],

    views: ['perfil.PerfilForm', 'perfil.PerfilGrid'],

    refs: [{
            ref: 'perfilGrid',
            selector: 'grid'
        }
    ],

    init: function() {
        this.control({
            'perfilgrid dataview': {
                itemdblclick: this.editarPerfil
            },
            'perfilgrid button#addPerfil': {
            	click: this.onAddPerfilClick
            },
            'perfilgrid button#deletePerfil': {
                click: this.deletePerfil
            },
            'perfilform button#salvaperfil': {
                click: this.onSavePerfilClick
            },
            'perfilform button#cancelaperfil': {
                click: this.onCancelClick
            }
        });
    },

    editarPerfil: function(grid, record) {
        var edit = Ext.create('crm.view.perfil.PerfilForm').show();
        console.log('Botão Adds Form');
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    },
    onAddPerfilClick: function(btn, e, eOpts){
    	Ext.create('crm.view.perfil.PerfilForm').show();
    }, 

    
    onSavePerfilClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('perfilgrid')[0],
    		store = grid.getStore();
    	
    	if (record){     // se for edicao		   		
    		record.set(values);
    		
    	} else{   // se for um novo
    		var perfil = Ext.create('crm.model.Perfil',{
    			id: values.id,
        		nome: values.nome,
        		ativo: values.ativo
        	});
        	
        	store.add(perfil);

    	}
    	store.sync(); 
    	win.close();
  },
    
    deletePerfil: function(button) {
    	
    	var grid = this.getPerfilGrid(),
    	record = grid.getSelectionModel().getSelection(), 
        store = this.getPerfilStore();

	    store.remove(record);
	    this.getPerfilStore().sync();

        //faz reload para atualziar
        this.getPerfilStore().load();
    }
});
