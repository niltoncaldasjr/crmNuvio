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
//			'pessoafisicagrid dataview': {
//				itemdblclick: this.editarPessoaFisica
//			},
			'pessoafisicagrid': {
				select: this.editarPessoaFisica
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

        var oeste 	= Ext.ComponentQuery.query('pessoafisicapanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('pessoafisicapanel panel#sul')[0];
        var form 	= Ext.ComponentQuery.query('pessoafisicatabpanel')[0];
        
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
		var oeste 	= Ext.ComponentQuery.query('pessoafisicapanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('pessoafisicapanel panel#sul')[0];

		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}
		var edit = Ext.ComponentQuery.query('pessoafisicaform')[0];

		edit.down('form').getForm().reset();
	},
	
	editarPessoaFisica: function(grid, record) {
		var oeste 	= Ext.ComponentQuery.query('pessoafisicapanel panel#oeste')[0];
        var sul		= Ext.ComponentQuery.query('pessoafisicapanel panel#sul')[0];
		
		if( sul.isVisible() == true ){
			sul.expand(true);
		}else if(oeste.isVisible() == true){
			oeste.expand(true);
		}else{
			//
		}
		
		var edit = Ext.ComponentQuery.query('pessoafisicaform')[0];
				
		if(record){
			edit.down('form').loadRecord(record);
		}
	},
	
	updatePessoaFisica: function(button){
		var win = button.up('panel').up('panel').up('panel'),
			form = win.down('form'),
			record = form.getRecord(),
			values = form.getValues();
		
		var novo = false;
		
		console.log(values['nome']);
		
		if( form.isValid() )
		{
//			var val = {
//				id:				values['id'],
//			    nome: 			values['nome'],
//			    cpf: 			values['cpf'],
//			    datanascimento:	new Date( values['datanascimento'] ),
//			    estadocivil: 	values['estadocivil'],
//			    sexo: 			values['sexo'],
//			    nomepai: 		values['nomepai'],
//			    nomemae: 		values['nomemae'],
//			    cor: 			values['cor'],
//			    naturalidade: 	values['naturalidade'],
//			    nacionalidade: 	values['nacionalidade']
//			};
			
//			console.log(val);
			
			if(values.id > 0){
				record.set(values);
				
//				record.set('datanascimento', new Date(values.datanascimento) );
			}else{
				record = Ext.create('crm.model.PessoaFisica');
				record.set(values);
				
				this.getPessoaFisicaStore().add(record);
				novo = true;
			}
			console.log(record.get('datanascimento'));
			//win.close();
			this.getPessoaFisicaStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getPessoaFisicaStore().load();
			}
			/*-- Limpa Form --*/
			win.down('form').getForm().reset();
			/*-- Minimiza a Tab --*/
			win.collapse( false );
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
		var win = button.up('panel').up('panel').up('panel');
		
		win.down('form').getForm().reset();
		win.collapse( false );
		
	}
	
});