Ext.define('crm.controller.Usuario', {
    extend: 'Ext.app.Controller',

    stores: ['Usuario'],

    models: ['Usuario'],

    views: ['usuario.UsuarioForm', 'usuario.UsuarioGrid'],

    refs: [{
        ref: 'usuarioGrid',
        selector: 'grid'
    }
    ],

    init: function() {
        this.control({
            'usuariogrid dataview': {
                itemdblclick: this.onEditaUsuario
            },
            'usuariogrid button#addUsuario': {
            	click: this.onAddUsuarioClick
            },
            'usuariogrid button#deleteUsuario': {
                click: this.onDeleteUsuarioClick
            },
            'usuarioform button#salvausuario': {
                click: this.onSaveUsuarioClick
            },
            'usuarioform button#cancelausuario': {
                click: this.onCancelUsuarioClick
            }
        });
    },

    onEditaUsuario: function(grid, record) {
        var edit = Ext.create('crm.view.usuario.UsuarioForm').show();        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelUsuarioClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddUsuarioClick: function(btn, e, eOpts){
    	Ext.create('crm.view.usuario.UsuarioForm').show();
    }, 

    
    onSaveUsuarioClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('usuariogrid')[0],
    		store = grid.getStore();
    	if(form.isValid()){
	    	if (values.id > 0){
				record.set(values);
	    		
	    	} else{   // se for um novo
	    		record = Ext.create('crm.model.Usuario');
	    		record.set(values);
	    		store.add(record);
	    	}
	    	win.close();
	        store.sync();
	    	store.load();
    	}
  },
  
  onDeleteUsuarioClick: function(btn, e, eOpts){
  	Ext.MessageBox.confirm('Confirmar', 'Deseja deletar?', function(botton){			
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
  }  
  
});
