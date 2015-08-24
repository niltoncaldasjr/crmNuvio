Ext.define('crm.controller.PessoaFisica',{
	extend: 'Ext.app.Controller',
	
	stores: ['PessoaFisica'],
	
	models: ['PessoaFisica'],
	
	views: ['pessoafisica.PessoaFisicaPanel'],
	
    refs: [
        {
        	ref: 'PessoaFisicaGrid',
        	selector: 'gridPessoaFisica'
    	},
    	{
            ref: 'TabPanel',
            selector: 'pessoafisicatabpanel'
        },
    	{
            ref: 'Form',
            selector: 'pessoafisicaform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'pessoafisicapanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'pessoafisicapanel panel#sul'
        }
    ],
	
	init: function(){
		this.control({
//			'pessoafisicagrid dataview': {
//				itemdblclick: this.editarPessoaFisica
//			},
			'pessoafisicagrid': {
				select: this.editarPessoaFisica,
				itemdblclick: this.editarPessoaFisica
			},
			'pessoafisicagrid button#addPessoaFisica': {
				click: this.novoPessoaFisica
			},
			'pessoafisicagrid button#deletePessoaFisica': {
				click: this.deletePessoaFisica
			},
			'pessoafisicaform button#salvaPessoaFisica': {
				click: this.updatePessoaFisica
			},
			'pessoafisicaform button#cancelaPessoaFisica': {
				click: this.cancelaPessoaFisica
			},
			'menu#posformpessoafisica menuitem': {
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
	
	novoPessoaFisica: function(){
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
	
	editarPessoaFisica: function(grid, record) {
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
	
	updatePessoaFisica: function(button){
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
				record = Ext.create('crm.model.PessoaFisica');
				record.set(values);
				
				this.getPessoaFisicaStore().add(record);
				novo = true;
			}
			
			this.getPessoaFisicaStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getPessoaFisicaStore().load();
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
	
	deletePessoaFisica: function(btn, e, opts){

		var form = this.getForm();
	    		
		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();

				/*-- Verificando se os dados tem dependentes --*/
				
				var StoreContatoLead = Ext.getStore('Usuario');
				modelContatoLead = StoreContatoLead.findRecord('idpessoafisica', records[0].get('id'));
				
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
	
	cancelaPessoaFisica: function(button){
//		var win = button.up('panel').up('panel').up('panel');
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