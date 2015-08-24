Ext.define('crm.controller.ContaBanco',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContaBanco'],
	
	models: ['ContaBanco'],
	
	views: ['contabanco.ContaBancoPanel'],
	
    refs: [
    	{
	        ref: 'ContaBancoGrid',
	        selector: 'grid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'contabancotabpanel'
        },
    	{
            ref: 'Form',
            selector: 'contabancoform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'contabancopanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'contabancopanel panel#sul'
        }
    ],
	
	init: function(){
		this.control({
			// 'contabancogrid dataview': {
			// 	itemdblclick: this.editarContaBanco
			// },
			'contabancogrid': {
				select: this.editarContaBanco,
				itemdblclick: this.editarContaBanco
			},
			'contabancogrid button#addContaBanco': {
				click: this.novoContaBanco
			},
			'contabancogrid button#deleteContaBanco': {
				click: this.deleteContaBanco
			},
			'contabancoform button#salvaContaBanco': {
				click: this.updateContaBanco
			},
			'contabancoform button#cancelaContaBanco': {
				click: this.cancelaContaBanco
			},
			'menu#posformcontabanco menuitem': {
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


	novoContaBanco: function(){

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
	
	editarContaBanco: function(grid, record) {
		
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
	
	updateContaBanco: function(button){
		
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

				record = Ext.create('crm.model.ContaBanco');
				record.set(values);
				this.getContaBancoStore().add(record);
				novo = true;
			}
			
			this.getContaBancoStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getContaBancoStore().load();
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
	
	deleteContaBanco: function(btn, e, opts){

		var form = this.getForm();
	    		
		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid');
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
	
	cancelaContaBanco: function(button){
		
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