Ext.define('crm.controller.LogSistema',{
	extend: 'Ext.app.Controller',
	
	stores: ['LogSistema'],
	
	models: ['LogSistema'],
	
	views: ['logsistema.LogSistemaGrid'],
	
    refs: [{
        ref: 'logSistemaGrid',
        selector: 'logsistemagrid'
    	}
    ],
	
	init: function(){
		this.control({
//			'bancogrid dataview': {
//				itemdblclick: this.editarBanco
//			},
//			'bancogrid button#addBanco': {
//				click: this.novoBanco
//			},
//			'bancogrid button#deleteBanco': {
//				click: this.deleteBanco
//			},
//			'bancoform button#salvaBanco': {
//				click: this.updateBanco
//			},
//			'bancoform button#cancelaBanco': {
//				click: this.cancelaBanco
//			}
		});
	},
	
//	novoBanco: function(){
//		// var edit = Ext.create('crm.view.banco.BancoForm').show();
//		var edit = Ext.ComponentQuery.query('bancoform')[0].expand(true);
//		
//		edit.down('form').getForm().reset();
//	},
//	
//	editarBanco: function(grid, record) {
//		// var edit = Ext.create('crm.view.banco.BancoForm').show();
//		var edit = Ext.ComponentQuery.query('bancoform')[0].expand(true);
//
//		if(record){
//			edit.down('form').loadRecord(record);
//		}
//	},
//	
//	updateBanco: function(button){
//		// var win = button.up('window'),
//		var win = button.up('panel'),
//			form = win.down('form'),
//			record = form.getRecord(),
//			values = form.getValues();
//		
//		var novo = false;
//		
//		if( form.isValid() )
//		{
//			if(values.id > 0){
//				record.set(values);
//			}else{
//				record = Ext.create('crm.model.Banco');
//				record.set(values);
//				this.getBancoStore().add(record);
//				novo = true;
//			}
//			console.log('botão salvar form');
//			//win.close();
//			this.getBancoStore().sync();
//			
//			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
//			if(novo){
//				this.getBancoStore().load();
//			}
//			/*-- Limpa Form --*/
//			win.down('form').getForm().reset();
//			/*-- Minimiza Form --*/
//			win.collapse( false );
//		}
//	},
//	
//	deleteBanco: function(btn, e, opts){
//
//		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
//			if(botton == 'yes'){
//				
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
//		
//	},
//	
//	cancelaBanco: function(button){
//		// var win = button.up('window');
//		button.up('panel').down('form').getForm().reset();
//		//win.close();
//		button.up('panel').collapse( false );
//	}
	
});