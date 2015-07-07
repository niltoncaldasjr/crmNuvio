Ext.define('crm.controller.ContaBanco',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContaBanco'],
	
	models: ['ContaBanco'],
	
	views: ['contabanco.ContaBancoForm', 'contabanco.ContaBancoGrid'],
	
    refs: [{
        ref: 'ContaBancoGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'contabancogrid dataview': {
				itemdblclick: this.editarContaBanco
			},
			'contabancogrid button#addContaBanco': {
				click: this.editarContaBanco
			},
			'contabancogrid button#deleteContaBanco': {
				click: this.deleteContaBanco
			},
			'contabancoform button#salvaContaBanco': {
				click: this.updateContaBanco
			},
			'contabancoform button#cancelaContaBanco': {
				click: this.cancelaContaBanco
			}
		});
	},
	
	editarContaBanco: function(grid, record) {
		var edit = Ext.create('crm.view.contabanco.ContaBancoForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateContaBanco: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.ContaBanco');
			record.set(values);
			this.getBancoStore().add(record);
			novo = true;
		}
		console.log('botão salvar form');
		win.close();
		this.getContaBancoStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getContaBancoStore().load();
		}
		this.getContaBancoStore().load();
	},
	
	deleteContaBanco: function(button){
		var grid = this.getContaBancoGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getContaBancoStore();
		
		store.remove(record);
		this.getContaBancoStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaContaBanco: function(button){
		var win = button.up('window');
		
		win.close();
	}
	
});