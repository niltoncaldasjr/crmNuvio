Ext.define('crm.controller.Lead',{
	extend: 'Ext.app.Controller',
	
	stores: ['Lead'],
	
	models: ['Lead'],
	
	views: ['lead.LeadPanel'],
	
    refs: [
    	{
	        ref: 'leadGrid',
	        selector: 'grid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'leadtabpanel'
        },
    	{
            ref: 'Form',
            selector: 'leadform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'leadpanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'leadpanel panel#sul'
        }
    ],
	
	init: function(){
		this.control({
			// 'leadgrid dataview': {
			// 	itemdblclick: this.editarLead
			// },
			'leadgrid': {
				select: this.editarLead,
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
			},
			'menu#posformlead menuitem': {
				click: this.posicaoForm
			}
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
	
	novoLead: function(){
		
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

	editarLead: function(grid, record) {
		
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
	
	updateLead: function(button){
		
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
				record = Ext.create('crm.model.Lead');
				record.set(values);
				this.getLeadStore().add(record);
				novo = true;
			}
			
			this.getLeadStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getLeadStore().load();
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
	
	deleteLead: function(btn, e, opts){
		
		var form = this.getForm();

		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();

				/*-- Verificando se os dados tem dependentes --*/
				
				var StoreContatoLead = Ext.getStore('ContatoLead');
				modelContatoLead = StoreContatoLead.findRecord('idlead', records[0].get('id'));
				
				if(modelContatoLead){
					
					Ext.Msg.show({
						title : 'Atenção!',
						msg : "Dados não podem ser excluídos pois existem dependentes!",
						icon : Ext.Msg.ERROR,
						buttons : Ext.Msg.OK
					});
					
				}else{
					
		    		form.getForm().reset();
			    	
				    store.remove(records);
				    store.sync();
				    	
				}
				

			}
			else if(botton == 'no'){
				return false;
			}
		}); 
		
	},
	
	cancelaLead: function(button){
		
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