Ext.define('crm.controller.ContatoLead',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContatoLead'],
	
	models: ['ContatoLead'],
	
	views: ['contatolead.ContatoLeadPanel'],
	
    refs: [
    	{
	        ref: 'ContatoLeadGrid',
	        selector: 'grid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'contatoleadtabpanel'
        },
    	{
            ref: 'Form',
            selector: 'contatoleadform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'contatoleadpanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'contatoleadpanel panel#sul'
        }
    ],
	
	init: function(){
		this.control({
			// 'contatoleadgrid dataview': {
			// 	itemdblclick: this.editarContatoLead
			'contatoleadgrid': {
				select: this.editarContatoLead,
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
			},
			'menu#posformcontatolead menuitem': {
				click: this.posicaoForm
			},
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

	novoContatoLead: function(){
		
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
	
	editarContatoLead: function(grid, record) {
		
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
	
	updateContatoLead: function(button){
		
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
	
	deleteContatoLead: function(btn, e, opts){
		
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
		
		
		/*-- reload na grid para atualizar a lista --*/
	},
	
	cancelaContatoLead: function(button){
		
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