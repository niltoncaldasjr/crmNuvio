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
            	click: this.editarPerfil
            },
            'perfilgrid button#deletePerfil': {
                click: this.deletePerfil
            },
            'perfilform button#salvaperfil': {
                click: this.updatePerfil
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
    	win.close(); 
    	console.log('Fechou');
    },
    updatePerfil: function(button) {
        var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
        
        var novo = false;
        
		if (values.id > 0){
			record.set(values);
		} else{
			record = Ext.create('crm.model.Perfil');
			record.set(values);
			this.getPerfilStore().add(record);
            novo = true;
		}
        
		win.close();
        this.getPerfilStore().sync();

        if (novo){ //faz reload para atualziar
            this.getPerfilStore().load();
        }
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
