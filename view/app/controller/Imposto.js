Ext.define('crm.controller.Imposto',{
	extend: 'Ext.app.Controller',
	
	stores: ['Imposto'],
	
	models: ['Imposto'],
	
	views: ['imposto.ImpostoPanel'],
	
    refs: [
    	{
	        ref: 'impostoGrid',
	        selector: 'impostogrid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'impostotabpanel'
        },
    	{
            ref: 'Form',
            selector: 'impostoform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'impostopanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'impostopanel panel#sul'
        }
    	
    ],
	
	init: function(){
		this.control({
			// 'bancogrid dataview': {
			// 	itemdblclick: this.editarBanco
			// },
			'impostogrid':  {
				select: this.editarImposto,
			},
			'impostogrid button#addImposto': {
				click: this.novoImposto
			},
			'impostogrid button#deleteImposto': {
				click: this.deleteImposto
			},
			'menu#posformimposto menuitem': {
				click: this.posicaoForm
			},
			'impostoform button#salvaimposto': {
				click: this.updateImposto
			},
			'impostoform button#cancelaimposto': {
				click: this.cancelaImposto
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

	novoImposto: function(){
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
	
	editarImposto: function(grid, record) {
		
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
	
	updateImposto: function(button){
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
				record = Ext.create('crm.model.Imposto');
				record.set(values);
				this.getImpostoStore().add(record);
				novo = true;
			}
			this.getImpostoStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getImpostoStore().load();
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
	
	deleteImposto: function(btn, e, opts){

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
		
	},
	
	cancelaImposto: function(button){
		
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