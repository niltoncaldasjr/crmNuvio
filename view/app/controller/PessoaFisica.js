Ext.define('crm.controller.PessoaFisica',{
	extend: 'Ext.app.Controller',
	
	stores: ['PessoaFisica'],
	
	models: ['PessoaFisica'],
	
	views: ['pessoafisica.PessoaFisicaPanel'],
	
    refs: [{
        ref: 'PessoaFisicaGrid',
        selector: 'gridPessoaFisica'
    	}
    ],
	
	init: function(){
		this.control({
			'pessoafisicagrid dataview': {
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
			}
		});
	},
	
	novoPessoaFisica: function(){
		// var edit = Ext.create('crm.view.pessoafisica.PessoaFisicaForm').show();
		var edit = Ext.ComponentQuery.query('pessoafisicatabpanel')[0].expand(true);
		
		edit.down('form').getForm().reset();
	},
	
	editarPessoaFisica: function(grid, record) {
		// var edit = Ext.create('crm.view.pessoafisica.PessoaFisicaForm').show();
		Ext.ComponentQuery.query('pessoafisicatabpanel')[0].expand(true);
		
		var edit = Ext.ComponentQuery.query('pessoafisicaform')[0];
		
		if(record){
			edit.down('form').loadRecord(record);
			
			console.log(record);
			
		}
	},
	
	updatePessoaFisica: function(button){
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
				record = Ext.create('crm.model.PessoaFisica');
				record.set(values);
				
				this.getPessoaFisicaStore().add(record);
				novo = true;
			}
			console.log(values.datanascimento);
			//win.close();
			this.getPessoaFisicaStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getPessoaFisicaStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza a Tab --*/
			win.up('panel').collapse( false );
		}
			
	},
	
	deletePessoaFisica: function(btn, e, opts){

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
	
	cancelaPessoaFisica: function(button){
		// var win = button.up('window');
		button.up('panel').down('form').getForm().reset();
		/*-- Minimiza a tab --*/
		button.up('panel').up('panel').collapse( false );
	}
	
});