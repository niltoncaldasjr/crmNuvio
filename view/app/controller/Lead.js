Ext.define('crm.controller.Lead',{
	extend: 'Ext.app.Controller',
	
	stores: ['Lead'],
	
	models: ['Lead'],
	
	views: ['lead.LeadForm', 'lead.LeadGrid'],
	
    refs: [{
        ref: 'leadGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'leadgrid dataview': {
				itemdblclick: this.editarLead
			},
			'leadgrid button#addLead': {
				click: this.editarLead
			},
			'leadgrid button#deleteLead': {
				click: this.deleteLead
			},
			'leadform button#salvaLead': {
				click: this.updateLead
			},
			'leadform button#cancelaLead': {
				click: this.cancelaLead
			}
		});
	},
	
	editarLead: function(grid, record) {
		var edit = Ext.create('crm.view.lead.LeadForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateLead: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.Lead');
			record.set(values);
			this.getLeadStore().add(record);
			novo = true;
		}
		console.log('botão salvar form');
		win.close();
		this.getLeadStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getLeadStore().load();
		}
		//this.getLeadStore().load();
	},
	
	deleteLead: function(button){
		var grid = this.getLeadGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getLeadStore();
		
		store.remove(record);
		this.getLeadStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaLead: function(button){
		var win = button.up('window');
		
		win.close();
	}
	
});