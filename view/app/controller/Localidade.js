Ext.define('crm.controller.Localidade', {
    extend: 'Ext.app.Controller',

    stores: ['Localidade'],

    models: ['Localidade'],

    views: ['localidade.LocalidadeForm', 'localidade.LocalidadeGrid'],

    refs: [{
        ref: 'localidadeGrid',
        selector: 'grid'
    }
    ],

    init: function() {
        this.control({
            'localidadegrid dataview': {
                itemdblclick: this.onEditaLocalidade
            },
            'localidadegrid button#addLocalidade': {
            	click: this.onAddLocalidadeClick
            },
            'localidadegrid button#deleteLocalidade': {
                click: this.onDeleteLocalidadeClick
            },
            'localidadeform button#salvalocalidade': {
                click: this.onSaveLocalidadeClick
            },
            'localidadeform button#cancelalocalidade': {
                click: this.onCancelLocalidadeClick
            }
        });
    },

    onEditaLocalidade: function(grid, record) {
        var edit = Ext.create('crm.view.localidade.LocalidadeForm').show();        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelLocalidadeClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddLocalidadeClick: function(btn, e, eOpts){
    	Ext.create('crm.view.localidade.LocalidadeForm').show();
    }, 

    
    onSaveLocalidadeClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('localidadegrid')[0],
    		store = grid.getStore();
    	
    	if (values.id > 0){
			record.set(values);
    		
    	} else{   // se for um novo
    		record = Ext.create('crm.model.Localidade');
    		record.set(values);
    		store.add(record);
    	}
    	win.close();
        store.sync();
    	store.load();
  },
  
  onDeleteLocalidadeClick: function(btn, e, eOpts){
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
  }  
  
});