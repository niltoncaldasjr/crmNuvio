Ext.define('crm.controller.Pais', {
    extend: 'Ext.app.Controller',

    stores: ['Pais'],

    models: ['Pais'],

    views: ['pais.PaisForm', 'pais.PaisGrid'],

    refs: [{
        ref: 'paisGrid',
        selector: 'grid'
    }
    ],

    init: function() {
        this.control({
            'paisgrid dataview': {
                itemdblclick: this.onEditaPais
            },
            'paisgrid button#addPais': {
            	click: this.onAddPaisClick
            },
            'paisgrid button#deletePais': {
                click: this.onDeletePaisClick
            },
            'paisform button#salvapais': {
                click: this.onSavePaisClick
            },
            'paisform button#cancelapais': {
                click: this.onCancelPaisClick
            }
        });
    },

    onEditaPais: function(grid, record) {
        var edit = Ext.create('crm.view.pais.PaisForm').show();        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelPaisClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddPaisClick: function(btn, e, eOpts){
    	Ext.create('crm.view.pais.PaisForm').show();
    }, 

    
    onSavePaisClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('paisgrid')[0],
    		store = grid.getStore();
    	
    	if (form.isValid()){
	    	if (values.id > 0){
				record.set(values);
	    		
	    	} else{   // se for um novo
	    		record = Ext.create('crm.model.Pais');
	    		record.set(values);
	    		store.add(record);
	    	}
	    	win.close();
	        store.sync();
	    	store.load();
    	}    	
  },
  
  onDeletePaisClick: function(btn, e, eOpts){
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