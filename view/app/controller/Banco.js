Ext.define('crm.controller.Banco',{
	extend: 'Ext.app.Controller',
	
	stores: ['Banco'],
	
	models: ['Banco'],
	
	views: ['banco.BancoPanel'],
	
	requires: ['crm.util.Alert'],
	
    refs: [
    	{
	        ref: 'bancoGrid',
	        selector: 'bancogrid'
    	},
    	{
            ref: 'TabPanel',
            selector: 'bancotabpanel'
        },
    	{
            ref: 'Form',
            selector: 'bancoform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'bancopanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'bancopanel panel#sul'
        }
    	
    ],
	
	init: function(){
		this.control({
			// 'bancogrid dataview': {
			// 	itemdblclick: this.editarBanco
			// },
			'bancogrid':  {
				select: this.editarBanco,
				itemdblclick: this.editarBanco
			},
			'bancogrid button#addBanco': {
				click: this.novoBanco
			},
			'bancogrid button#deleteBanco': {
				click: this.deleteBanco
			},
			'menu#posformbanco menuitem': {
				click: this.posicaoForm
			},
			'bancoform button#salvaBanco': {
				click: this.updateBanco
			},
			'bancoform button#cancelaBanco': {
				click: this.cancelaBanco
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

	novoBanco: function(){
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
	
	editarBanco: function(grid, record) {
		
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
	
	updateBanco: function(button){
		var winoeste = this.getPanelOeste();
		var winsul = this.getPanelSul();
			form = this.getForm();
			record = form.getRecord();
			
			console.log( record );
			
			values = form.getValues();
		
		var novo = false;
		
		if( form.isValid() )
		{
			if(values.id > 0){
				record.set(values);
			}else{
				record = Ext.create('crm.model.Banco');
				record.set(values);
				this.getBancoStore().add(record);
				novo = true;
			}
//			this.getBancoStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getBancoStore().load();
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
	
	deleteBanco: function(btn, e, opts){

		var form = this.getForm();
	    		
		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid');
				records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();
	    		
				/*-- Verificando se os dados tem dependentes --*/
				
				var StoreContatoLead = Ext.getStore('ContaBanco');
				modelContatoLead = StoreContatoLead.findRecord('idbanco', records[0].get('id'));
				
				if(modelContatoLead){
					
					Ext.Msg.show({
						title : 'Atenção!',
						msg : "Dados não podem ser excluídos pois existem dependentes!",
						icon : Ext.Msg.ERROR,
						buttons : Ext.Msg.OK
					});
					
				}else{
					
		    		form.getForm().reset();
			    	
		    		crm.util.Alert.msg('Successo!', 'Banco Deletado!');
		    		
				    store.remove(records);
				    store.sync();
				    	
				}
		    	
			}
			else if(botton == 'no'){
				return false;
			}
		});  	
		
	},
	
	cancelaBanco: function(button){
		
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