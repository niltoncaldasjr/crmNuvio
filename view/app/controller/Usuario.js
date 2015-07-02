Ext.define('crm.controller.Usuario', {
    extend: 'Ext.app.Controller',

    stores: ['Usuario'],

    models: ['Usuario'],

    views: ['usuario.UsuarioForm', 'usuario.UsuarioGrid'],

    //refs: [{
    //        ref: 'contatoPanel',
    //        selector: 'panel'
    //    },{
    //        ref: 'contatoGrid',
    //        selector: 'grid'
    //    }
    //],

    init: function() {
        this.control({
            'usuariogrid dataview': {
                itemdblclick: this.editarUsuario
            },
            'usuariogrid button[action=add]': {
            	click: this.editarUsuario
            },
            'usuariogrid button[action=delete]': {
                click: this.deleteUsuario
            },
            'usuarioform button[action=save]': {
                click: this.updateUsuario
            }
        });
    },

    editarUsuario: function(grid, record) {
        var edit = Ext.create('crm.view.usuario.UsuarioForm').show();
        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    
    updateUsuario: function(button) {
        var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
        
        var novo = false;
        
		if (values.id > 0){
			record.set(values);
		} else{
			record = Ext.create('crm.model.Usuario');
			record.set(values);
			this.getUsuarioStore().add(record);
            novo = true;
		}
        
		win.close();
        this.getUsuarioStore().sync();

        if (novo){ //faz reload para atualziar
            this.getUsuarioStore().load();
        }
    },
    
    deleteUsuario: function(button) {
    	
    	var grid = this.getUsuarioGrid(),
    	record = grid.getSelectionModel().getSelection(), 
        store = this.getUsuarioStore();

	    store.remove(record);
	    this.getUsuarioStore().sync();

        //faz reload para atualziar
        this.getUsuarioStore().load();
    }
});
