Ext.define('crm.controller.Empresa', {
    extend: 'Ext.app.Controller',

    stores: ['Empresa'],

    models: ['Empresa'],

    views: ['empresa.EmpresaForm', 'empresa.EmpresaGrid'],

    refs: [{
        ref: 'empresaGrid',
        selector: 'empresagrid'
    }
    ],

    init: function() {
        this.control({
            'empresagrid dataview': {
                itemdblclick: this.onEditaEmpresa
            },
            'empresagrid button#addEmpresa': {
            	click: this.onAddEmpresaClick
            },
            'empresagrid button#deleteEmpresa': {
                click: this.onDeleteEmpresaClick
            },
            'empresaform button#salvaempresa': {
                click: this.onSaveEmpresaClick
            },
            'empresaform button#cancelaempresa': {
                click: this.onCancelEmpresaClick
            }
        });
    },

    onEditaEmpresa: function(grid, record) {
        var edit = Ext.create('crm.view.empresa.EmpresaForm').show();        
        if(record){
        	edit.down('form').loadRecord(record);
//        	if (record.get('imagemLogotipo')) { // #4
//				var img = editWindow.down('filefield');
//				img.setSrc('resources/profileImages/' + record[0].get('picture'));
//			}
        }
    },
    onCancelEmpresaClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddEmpresaClick: function(btn, e, eOpts){
    	Ext.create('crm.view.empresa.EmpresaForm').show();
    }, 

    
//    onSaveEmpresaClick: function(btn, e, eOpts){
//    	var win = btn.up('window'),
//    		form = win.down('form'),
//    		values = form.getValues(),
//    		record = form.getRecord(),
//    		grid = Ext.ComponentQuery.query('empresagrid')[0],
//    		store = grid.getStore();
//    	
//    	if (values.id > 0){
//			record.set(values);
//    		
//    	} else{   // se for um novo
//    		record = Ext.create('crm.model.Empresa');
//    		record.set(values);
//    		store.add(record);
//    	}
//    	win.close();
//        store.sync();
//    	store.load();
//  },
    
   onSaveEmpresaClick: function(btn, e, eOpts){
	var win = btn.up('window'),
	form = win.down('form'),
	grid = Ext.ComponentQuery.query('empresagrid')[0],
	store = grid.getStore();

	if(form.isValid()){
		form.submit({
			url: 'rest/empresa/criar_atualizar.php',//			
			waitMsg: 'Enviando sua Logo...',
			success: function(tp, o){
				var result = o.result; 
				if (result.success) {
					store.load();
					win.close();
				}
			},
			failure: function(form, action) {
				console.log('erro');
				switch (action.failureType) {
					case Ext.form.action.Action.CLIENT_INVALID:
						Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
						break;
					case Ext.form.action.Action.CONNECT_FAILURE:
						Ext.Msg.alert('Failure', 'Ajax communication failed');
						break;
					case Ext.form.action.Action.SERVER_INVALID:
						Ext.Msg.alert('Failure', action.result.msg);
				}
			}	
		});
		}
   },
  
  onDeleteEmpresaClick: function(btn, e, eOpts){
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