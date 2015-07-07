Ext.define('crm.controller.Imposto', {
    extend: 'Ext.app.Controller',

    stores: ['Imposto'],

    models: ['Imposto'],

    views: ['imposto.ImpostoForm', 'imposto.ImpostoGrid'],

    refs: [{
        ref: 'impostoGrid',
        selector: 'grid'
    }
    ],

    init: function() {
        this.control({
            'impostogrid dataview': {
                itemdblclick: this.onEditaImposto
            },
            'impostogrid button#addImposto': {
            	click: this.onAddImpostoClick
            },
            'impostogrid button#deleteImposto': {
                click: this.onDeleteImpostoClick
            },
            'impostoform button#salvaimposto': {
                click: this.onSaveImpostoClick
            },
            'impostoform button#cancelaimposto': {
                click: this.onCancelImpostoClick
            }
        });
    },

    onEditaImposto: function(grid, record) {
        var edit = Ext.create('crm.view.imposto.ImpostoForm').show();        
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelImpostoClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddImpostoClick: function(btn, e, eOpts){
    	Ext.create('crm.view.imposto.ImpostoForm').show();
    }, 

    
    onSaveImpostoClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('impostogrid')[0],
    		store = grid.getStore();
    	
    	if (values.id > 0){
			record.set(values);
    		
    	} else{   // se for um novo
    		record = Ext.create('crm.model.Imposto');
    		record.set(values);
    		store.add(record);
    	}
    	win.close();
        store.sync();
    	store.load();
  },
  
  onDeleteImpostoClick: function(btn, e, eOpts){
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