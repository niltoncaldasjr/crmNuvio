Ext.define('crm.controller.ContatoLead',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContatoLead'],
	
	models: ['ContatoLead'],
	
	views: ['contatolead.ContatoLeadPanel'],
	
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
				click: this.novoContatoLead
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
	
	novoContatoLead: function(){
		// var edit = Ext.create('crm.view.contatolead.ContatoLeadForm').show();
		var edit = Ext.ComponentQuery.query('contatoleadform')[0].expand(true);
		
		edit.down('form').getForm().reset();
	},
	
	editarContatoLead: function(grid, record) {
		// var edit = Ext.create('crm.view.contatolead.ContatoLeadForm').show();
		var edit = Ext.ComponentQuery.query('contatoleadform')[0].expand(true);
		
		if(record){
			edit.down('form').loadRecord(record);
			
		}
	},
	
	updateContatoLead: function(button){
		//var win = button.up('window'),
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
				record = Ext.create('crm.model.ContatoLead');
				record.set(values);
				this.getContatoLeadStore().add(record);
				novo = true;
			}
			console.log('botão salvar form');
			// win.close();
			this.getContatoLeadStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getContatoLeadStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza Form --*/
			win.collapse( false );
			
			console.log('O formulario é válido');
			
		}
	},
	
	deleteContatoLead: function(btn, e, opts){
		
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
		
		
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaContatoLead: function(button){
		// var win = button.up('window');
		button.up('panel').down('form').getForm().reset();
		//win.close();
		button.up('panel').collapse( false );
	}
	
});