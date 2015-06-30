Ext.define('crm.controller.Contatos', {
    extend: 'Ext.app.Controller',

    stores: ['Pais'],

    models: ['Pais'],

    views: ['pais.PaisForm', 'pais.PaisGrid'],

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
            'paisgrid dataview': {
                itemdblclick: this.editarPais
            },
            'paisgrid button[action=add]': {
            	click: this.editarPais
            },
            'paisgrid button[action=delete]': {
                click: this.deletePais
            },
            'paisform button[action=save]': {
                click: this.updatePais
            }
        });
    },

    editarPais: function(grid, record) {
        var edit = Ext.create('crm.view.pais.PaisForm').show();
        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    
    updatePais: function(button) {
        var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
        
        var novo = false;
        
		if (values.id > 0){
			record.set(values);
		} else{
			record = Ext.create('crm.model.Pais');
			record.set(values);
			this.getPaisStore().add(record);
            novo = true;
		}
        
		win.close();
        this.getContatosStore().sync();

        if (novo){ //faz reload para atualziar
            this.getPaisStore().load();
        }
    },
    
    deletePais: function(button) {
    	
    	var grid = this.getPaisGrid(),
    	record = grid.getSelectionModel().getSelection(), 
        store = this.getPaisStore();

	    store.remove(record);
	    this.getPaisStore().sync();

        //faz reload para atualziar
        this.getPaisStore().load();
    }
});
