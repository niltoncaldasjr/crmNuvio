Ext.define('crm.controller.ContaBanco',{
	extend: 'Ext.app.Controller',
	
	stores: ['ContaBanco'],
	
	models: ['ContaBanco'],
	
	views: ['contabanco.ContaBancoPanel'],
	
    refs: [{
        ref: 'ContaBancoGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'contabancogrid dataview': {
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
			}
		});
	},
	
	novoContaBanco: function(){
		// var edit = Ext.create('crm.view.contabanco.ContaBancoForm').show();
		var edit = Ext.ComponentQuery.query('contabancoform')[0].expand(true);
		
		edit.down('form').getForm().reset();
	},
	
	editarContaBanco: function(grid, record) {
		// var edit = Ext.create('crm.view.contabanco.ContaBancoForm').show();
		var edit = Ext.ComponentQuery.query('contabancoform')[0].expand(true);
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updateContaBanco: function(button){
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
				record = Ext.create('crm.model.ContaBanco');
				record.set(values);
				this.getContaBancoStore().add(record);
				novo = true;
			}
			console.log('botão salvar form');
			//win.close();
			this.getContaBancoStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getContaBancoStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza Form --*/
			win.collapse( false );
		}
	},
	
	deleteContaBanco: function(btn, e, opts){

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
	
	cancelaContaBanco: function(button){
		// var win = button.up('window');
		button.up('panel').down('form').getForm().reset();
		//win.close();
		button.up('panel').collapse( false );
	}
	
});