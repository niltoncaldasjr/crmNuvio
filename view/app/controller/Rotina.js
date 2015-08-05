Ext.define('crm.controller.Rotina',{
	extend: 'Ext.app.Controller',
	
	stores: ['Rotina'],
	
	models: ['Rotina'],
	
	views: ['rotina.RotinaForm', 'rotina.RotinaGrid'],
	
    refs: [{
        ref: 'rotinaGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'rotinagrid dataview': {
				itemdblclick: this.editarRotina
			},
			'rotinagrid button#addRotina': {
				click: this.editarRotina
			},
			'rotinagrid button#deleteRotina': {
				click: this.deleteRotina
			},
			'rotinaform button#salvaRotina': {
				click: this.updateRotina
			},
			'rotinaform button#cancelaRotina': {
				click: this.cancelaRotina
			}
		});
	},
	
	editarRotina: function(grid, record) {
		var edit = Ext.create('crm.view.rotina.RotinaForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateRotina: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.Rotina');
			record.set(values);
			this.getRotinaStore().add(record);
			novo = true;
		}
		console.log('botão salvar form');
		win.close();
		this.getRotinaStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getRotinaStore().load();
		}
	},
	
	deleteRotina: function(button){
		var grid = this.getRotinaGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getRotinaStore();
		
		store.remove(record);
		this.getRotinaStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
//		this.getRotinaStore().load();
	},
	
	cancelaRotina: function(button){
		var win = button.up('window');
		
		win.close();
	}
	
});