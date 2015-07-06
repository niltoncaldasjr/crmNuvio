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
                itemdblclick: this.onEditaPerfil
            },
            'perfilgrid button#addPerfil': {
            	click: this.onAddPerfilClick
            },
            'perfilgrid button#deletePerfil': {
                click: this.onDeletePerfilClick
            },
            'perfilform button#salvaperfil': {
                click: this.onSavePerfilClick
            },
            'perfilform button#cancelaperfil': {
                click: this.onCancelPerfilClick
            }
        });
    },

    onEditaPerfil: function(grid, record) {
        var edit = Ext.create('crm.view.perfil.PerfilForm').show();
        console.log('Botão Adds Form');
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelPerfilClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
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
    	
    	if (values.id > 0){
			record.set(values);
    		
    	} else{   // se for um novo
    		record = Ext.create('crm.model.Perfil');
    		record.set(values);
    		store.add(record);
    	}
    	win.close();
        store.sync();
    	store.load();
  },
  
  onDeletePerfilClick: function(btn, e, eOpts){
  	Ext.MessageBox.confirm('Confirma', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();
	    	
		    	store.remove(records);
		    	store.sync();
		    	
			}
			else if(botton == 'no'){
				return false;
			}
		});
  	
  }//,
    
//    onDeletePerfilClick: function(button) {
//    	
//    	var grid = this.getPerfilGrid(),
//    	record = grid.getSelectionModel().getSelection(), 
//        store = this.getPerfilStore();
//
//	    store.remove(record);
//	    this.getPerfilStore().sync();
//
//        //faz reload para atualziar
//        this.getPerfilStore().load();
//    }
  
  
});
