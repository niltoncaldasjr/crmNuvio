Ext.define('crm.controller.ContatoLead',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContatoLead'],
	
	models: ['ContatoLead'],
	
	views: ['contatolead.ContatoLeadForm', 'contatolead.ContatoLeadGrid'],
	
    refs: [{
        ref: 'ContatoLeadGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'contatoleadgrid dataview': {
				itemdblclick: this.editarContatoLead
			},
			'contatoleadgrid button#addContatoLead': {
				click: this.editarContatoLead
			},
			'contatoleadgrid button#deleteContatoLead': {
				click: this.deleteContatoLead
			},
			'contatoleadform button#salvaContatoLead': {
				click: this.updateContatoLead
			},
			'contatoleadform button#cancelaContatoLead': {
				click: this.cancelaContatoLead
			}
		});
	},
	
	editarContatoLead: function(grid, record) {
		var edit = Ext.create('crm.view.contatolead.ContatoLeadForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateContatoLead: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.ContatoLead');
			record.set(values);
			this.getContatoLeadStore().add(record);
			novo = true;
		}
		console.log('botão salvar form');
		win.close();
		this.getContatoLeadStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getContatoLeadStore().load();
		}
		this.getContatoLeadStore().load();
	},
	
	deleteContatoLead: function(button){
		var grid = this.getContatoLeadGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getContatoLeadStore();
		
		store.remove(record);
		this.getContatoLeadStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaContatoLead: function(button){
		var win = button.up('window');
		
		win.close();
	}
	
});