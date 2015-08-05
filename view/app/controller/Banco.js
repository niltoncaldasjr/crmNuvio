Ext.define('crm.controller.Banco',{
	extend: 'Ext.app.Controller',
	
	stores: ['Banco'],
	
	models: ['Banco'],
	
	views: ['banco.BancoForm', 'banco.BancoGrid'],
	
    refs: [{
        ref: 'bancoGrid',
        selector: 'bancogrid'
    	}
    ],
	
	init: function(){
		this.control({
			'bancogrid dataview': {
				itemdblclick: this.editarBanco
			},
			'bancogrid button#addBanco': {
				click: this.editarBanco
			},
			'bancogrid button#deleteBanco': {
				click: this.deleteBanco
			},
			'bancoform button#salvaBanco': {
				click: this.updateBanco
			},
			'bancoform button#cancelaBanco': {
				click: this.cancelaBanco
			}
		});
	},
	
	editarBanco: function(grid, record) {
		var edit = Ext.create('crm.view.banco.BancoForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateBanco: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.Banco');
			record.set(values);
			this.getBancoStore().add(record);
			novo = true;
		}
		console.log('botão salvar form');
		win.close();
		this.getBancoStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getBancoStore().load();
		}
		//this.getBancoStore().load();
	},
	
	deleteBanco: function(button){
		var grid = this.getBancoGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getBancoStore();
		
		store.remove(record);
		this.getBancoStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaBanco: function(button){
		var win = button.up('window');
		
		win.close();
	}
	
});