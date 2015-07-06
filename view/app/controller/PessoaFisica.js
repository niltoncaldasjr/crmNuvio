Ext.define('crm.controller.PessoaFisica',{
	extend: 'Ext.app.Controller',
	
	stores: ['PessoaFisica'],
	
	models: ['PessoaFisica'],
	
	views: ['pessoafisica.PessoaFisicaForm', 'pessoafisica.PessoaFisicaGrid'],
	
    refs: [{
        ref: 'PessoaFisicaGrid',
        selector: 'grid'
    	}
    ],
	
	init: function(){
		this.control({
			'pessoafisicagrid dataview': {
				itemdblclick: this.editarPessoaFisica
			},
			'pessoafisicagrid button#addPessoaFisica': {
				click: this.editarPessoaFisica
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
	
	editarPessoaFisica: function(grid, record) {
		var edit = Ext.create('crm.view.pessoafisica.PessoaFisicaForm').show();
		
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updatePessoaFisica: function(button){
		var win = button.up('window'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		if(values.id > 0){
			record.set(values);
		}else{
			record = Ext.create('crm.model.PessoaFisica');
			record.set(values);
			this.getPessoaFisicaStore().add(record);
			novo = true;
		}
		console.log(values.datanascimento);
		win.close();
		this.getPessoaFisicaStore().sync();
		
		/*-- Se o novo for true da reload na grid para atualizar a lista --*/
		if(novo){
			this.getPessoaFisicaStore().load();
		}
		this.getPessoaFisicaStore().load();
	},
	
	deletePessoaFisica: function(button){
		var grid = this.getPessoaFisicaGrid(),
		record = grid.getSelectionModel().getSelection(),
		store = this.getPessoaFisicaStore();
		
		store.remove(record);
		this.getPessoaFisicaStore().sync();
		
		/*-- reload na grid para atualizar a lista --*/
		this.getPessoaFisicaStore().load();
	},
	
	cancelaPessoaFisica: function(button){
		var win = button.up('window');
		console.log('Entramos aqui');
		
		win.close();
	}
	
});