Ext.define('crm.controller.Lead',{
	extend: 'Ext.app.Controller',
	
	stores: ['Lead'],
	
	models: ['Lead'],
	
	views: ['lead.LeadPanel'],
	
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
				click: this.novoLead
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
	
	novoLead: function(){
		// var edit = Ext.create('crm.view.lead.LeadForm').show();
		var edit = Ext.ComponentQuery.query('leadform')[0].expand(true);
		
		edit.down('form').getForm().reset();
	},
	
	editarLead: function(grid, record) {
		// var edit = Ext.create('crm.view.lead.LeadForm').show();
		var edit = Ext.ComponentQuery.query('leadform')[0].expand(true);
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateLead: function(button){
		// var win = button.up('window'),
		var win = button.up('panel'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if( form.isValid() )
		{
			
			if(values.id > 0){
				record.set(values);
			}else{
				record = Ext.create('crm.model.Lead');
				record.set(values);
				this.getLeadStore().add(record);
				novo = true;
			}
			console.log('botão salvar form');
			// win.close();
			this.getLeadStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getLeadStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza Form --*/
			win.collapse( false );
		}
	},
	
	deleteLead: function(btn, e, opts){

		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
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
		
	},
	
	cancelaLead: function(button){
		// var win = button.up('window');
		button.up('panel').down('form').getForm().reset();
		//win.close();
		button.up('panel').collapse( false );
	}
	
});