Ext.define('crm.controller.Localidade',{
	extend: 'Ext.app.Controller',
	
	stores: ['Localidade'],
	
	models: ['Localidade'],
	
	views: ['localidade.LocalidadePanel'],
	
    refs: [
    	{
	        ref: 'localidadeGrid',
	        selector: 'localidadegrid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'localidadetabpanel'
        },
    	{
            ref: 'Form',
            selector: 'localidadeform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'localidadepanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'localidadepanel panel#sul'
        }
    	
    ],
	
	init: function(){
		this.control({
			// 'bancogrid dataview': {
			// 	itemdblclick: this.editarBanco
			// },
			'localidadegrid':  {
				select: this.editarLocalidade,
			},
			'localidadegrid button#addLocalidade': {
				click: this.novoLocalidade
			},
			'localidadegrid button#deleteLocalidade': {
				click: this.deleteLocalidade
			},
			'menu#posformlocalidade menuitem': {
				click: this.posicaoForm
			},
			'localidadeform button#salvalocalidade': {
				click: this.updateLocalidade
			},
			'localidadeform button#cancelalocalidade': {
				click: this.cancelaLocalidade
			}
		});
	},
	
	posicaoForm: function(item, e, options) {

		 var button = item.up('button');

	        var oeste 	= this.getPanelOeste();
	        var sul		= this.getPanelSul();
	        var form 	= this.getTabPanel();
	        
	        switch (item.itemId) {
	            case 'bottom':
	                oeste.hide();
	                sul.show();
	                sul.add(form);
	                button.setIconCls('bottom');
	                button.setText('Abaixo');
	                break;
	            case 'right':
	                sul.hide();
	                oeste.show();
	                oeste.add(form);
	                button.setIconCls('right');
	                button.setText('À Direita');
	                break;
	            default:
	                sul.hide();
	                oeste.hide();
	                button.setIconCls('hide');
	                button.setText('Oculto');
	                break;
	     }
    },

	novoLocalidade: function(){
		var oeste 	= this.getPanelOeste();
        var sul		= this.getPanelSul();

		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}
		
		this.getForm().getForm().reset();
	},
	
	editarLocalidade: function(grid, record) {
		
		var oeste 	= this.getPanelOeste();
        var sul		= this.getPanelSul();
		
		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}
				
		if(record){
			this.getForm().loadRecord(record);
		}
		
	},
	
	updateLocalidade: function(button){
		var winoeste = this.getPanelOeste();
		var winsul = this.getPanelSul();
			form = this.getForm();
			record = form.getRecord();
			values = form.getValues();
		
		var novo = false;
		
		if( form.isValid() )
		{
			if(values.id > 0){
				record.set(values);
			}else{
				record = Ext.create('crm.model.Localidade');
				record.set(values);
				this.getLocalidadeStore().add(record);
				novo = true;
			}
			this.getLocalidadeStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getLocalidadeStore().load();
			}
			/*-- Limpa Form --*/
			form.getForm().reset();
			
			/*-- Minimiza a Tab --*/
			if(winoeste){
				winoeste.collapse( false );
			}else if(winsul){
				winsul.collapse( false );
			}else{
				//nada
			}
		}
		
	},
	
	deleteLocalidade: function(btn, e, opts){
		
		var form = this.getForm();

		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();
				
				form.getForm().reset();
	    	
	    		store.remove(records);
		    	store.sync();
		    	
			}
			else if(botton == 'no'){
				return false;
			}
		});  	
		
	},
	
	cancelaLocalidade: function(button){
		
		var winoeste = this.getPanelOeste();
		var winsul = this.getPanelSul();
		var form = this.getForm();
		
		form.getForm().reset();
		
		if(winoeste){
			winoeste.collapse( false );
		}else if(winsul){
			winsul.collapse( false );
		}else{
			//nada
		}
		
	}
	
});


//Ext.define('crm.controller.Pais', {
//    extend: 'Ext.app.Controller',
//
//    stores: ['Pais'],
//
//    models: ['Pais'],
//
//    views: ['pais.PaisForm', 'pais.PaisGrid'],
//
//    refs: [{
//        ref: 'paisGrid',
//        selector: 'grid'
//    }
//    ],
//
//    init: function() {
//        this.control({
//            'paisgrid dataview': {
//                itemdblclick: this.onEditaPais
//            },
//            'paisgrid button#addPais': {
//            	click: this.onAddPaisClick
//            },
//            'paisgrid button#deletePais': {
//                click: this.onDeletePaisClick
//            },
//            'paisform button#salvapais': {
//                click: this.onSavePaisClick
//            },
//            'paisform button#cancelapais': {
//                click: this.onCancelPaisClick
//            }
//        });
//    },
//
//    onEditaPais: function(grid, record) {
//        var edit = Ext.create('crm.view.pais.PaisForm').show();        
//        if(record){
//        	edit.down('form').loadRecord(record);
//        }
//    },
//    onCancelPaisClick: function(btn, e, eOpts){
//    	var win = btn.up('window');
//    	var form = win.down('form');
//    	form.getForm().reset();
//    	win.close();
//    },
//    onAddPaisClick: function(btn, e, eOpts){
//    	Ext.create('crm.view.pais.PaisForm').show();
//    }, 
//
//    
//    onSavePaisClick: function(btn, e, eOpts){
//    	var win = btn.up('window'),
//    		form = win.down('form'),
//    		values = form.getValues(),
//    		record = form.getRecord(),
//    		grid = Ext.ComponentQuery.query('paisgrid')[0],
//    		store = grid.getStore();
//    	
//    	if (form.isValid()){
//	    	if (values.id > 0){
//				record.set(values);
//	    		
//	    	} else{   // se for um novo
//	    		record = Ext.create('crm.model.Pais');
//	    		record.set(values);
//	    		store.add(record);
//	    	}
//	    	win.close();
//	        store.sync();
//	    	store.load();
//    	}    	
//  },
//  
//  onDeletePaisClick: function(btn, e, eOpts){
//  	Ext.MessageBox.confirm('Confirma', 'Deseja realmente deletar?', function(botton){			
//			if(botton == 'yes'){
//				var grid = btn.up('grid'),
//	    		records = grid.getSelectionModel().getSelection(),
//	    		store = grid.getStore();
//	    	
//		    	store.remove(records);
//		    	store.sync();
//		    	
//			}
//			else if(botton == 'no'){
//				return false;
//			}
//		});  	
//  }  
//  
//});


//Ext.define('crm.controller.Localidade', {
//    extend: 'Ext.app.Controller',
//
//    stores: ['Localidade'],
//
//    models: ['Localidade'],
//
//    views: ['localidade.LocalidadeForm', 'localidade.LocalidadeGrid'],
//
//    refs: [{
//        ref: 'localidadeGrid',
//        selector: 'grid'
//    }
//    ],
//
//    init: function() {
//        this.control({
//            'localidadegrid dataview': {
//                itemdblclick: this.onEditaLocalidade
//            },
//            'localidadegrid button#addLocalidade': {
//            	click: this.onAddLocalidadeClick
//            },
//            'localidadegrid button#deleteLocalidade': {
//                click: this.onDeleteLocalidadeClick
//            },
//            'localidadeform button#salvalocalidade': {
//                click: this.onSaveLocalidadeClick
//            },
//            'localidadeform button#cancelalocalidade': {
//                click: this.onCancelLocalidadeClick
//            }
//        });
//    },
//
//    onEditaLocalidade: function(grid, record) {
//        var edit = Ext.create('crm.view.localidade.LocalidadeForm').show();        
//        if(record){
//        	edit.down('form').loadRecord(record);
//        }
//    },
//    onCancelLocalidadeClick: function(btn, e, eOpts){
//    	var win = btn.up('window');
//    	var form = win.down('form');
//    	form.getForm().reset();
//    	win.close();
//    },
//    onAddLocalidadeClick: function(btn, e, eOpts){
//    	Ext.create('crm.view.localidade.LocalidadeForm').show();
//    }, 
//
//    
//    onSaveLocalidadeClick: function(btn, e, eOpts){
//    	var win = btn.up('window'),
//    		form = win.down('form'),
//    		values = form.getValues(),
//    		record = form.getRecord(),
//    		grid = Ext.ComponentQuery.query('localidadegrid')[0],
//    		store = grid.getStore();
//    	
//    	if (form.isValid()){
//	    	if (values.id > 0){
//				record.set(values);
//	    		
//	    	} else{   // se for um novo
//	    		record = Ext.create('crm.model.Localidade');
//	    		record.set(values);
//	    		store.add(record);
//	    	}
//	    	win.close();
//	        store.sync();
//	    	store.load();
//    	}    	
//  },
//  
//  onDeleteLocalidadeClick: function(btn, e, eOpts){
//  	Ext.MessageBox.confirm('Confirma', 'Deseja realmente deletar?', function(botton){			
//			if(botton == 'yes'){
//				var grid = btn.up('grid'),
//	    		records = grid.getSelectionModel().getSelection(),
//	    		store = grid.getStore();
//	    	
//		    	store.remove(records);
//		    	store.sync();
//		    	
//			}
//			else if(botton == 'no'){
//				return false;
//			}
//		});  	
//  }  
//  
//});