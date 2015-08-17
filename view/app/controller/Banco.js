Ext.define('crm.controller.Banco',{
	extend: 'Ext.app.Controller',
	
	stores: ['Banco'],
	
	models: ['Banco'],
	
	views: ['banco.BancoPanel'],
	
    refs: [
    	{
	        ref: 'bancoGrid',
	        selector: 'bancogrid'
    	}
    	
    ],
	
	init: function(){
		this.control({
			// 'bancogrid dataview': {
			// 	itemdblclick: this.editarBanco
			// },
			'bancogrid':  {
				select: this.editarBanco,
			},
			'bancogrid button#addBanco': {
				click: this.novoBanco
			},
			'bancogrid button#deleteBanco': {
				click: this.deleteBanco
			},
			'menu#posform menuitem': {
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

        var oeste 	= Ext.ComponentQuery.query('bancopanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('bancopanel panel#sul')[0];
        var form 	= Ext.ComponentQuery.query('bancoform')[0];
        
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
		// var edit = Ext.create('crm.view.banco.BancoForm').show();
		
		var oeste 	= Ext.ComponentQuery.query('bancopanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('bancopanel panel#sul')[0];

		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}
		var edit = Ext.ComponentQuery.query('bancoform')[0];

		edit.down('form').getForm().reset();
	},
	
	editarBanco: function(grid, record) {
		// var edit = Ext.create('crm.view.banco.BancoForm').show();

		var oeste 	= Ext.ComponentQuery.query('bancopanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('bancopanel panel#sul')[0];

		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}

		var edit = Ext.ComponentQuery.query('bancoform')[0];

		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateBanco: function(button){
		// var win = button.up('window'),
		var win = button.up('panel').up('panel');
			form = win.down('panel').down('form'),
			record = form.getRecord(),
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
			console.log('botão salvar form');
			//win.close();
			this.getBancoStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getBancoStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza Form --*/
			win.collapse( false );
		}
	},
	
	deleteBanco: function(btn, e, opts){

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
	
	cancelaBanco: function(button){
		var win = button.up('panel').up('panel');
		
		win.down('form').getForm().reset();
		win.collapse( false );
	}
	
});