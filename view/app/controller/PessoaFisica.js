Ext.define('crm.controller.PessoaFisica',{
	extend: 'Ext.app.Controller',
	
	stores: ['PessoaFisica', 'ContatoPF', 'DocumentoPF', 'EnderecoPF'],
	
	models: ['PessoaFisica', 'ContatoPF', 'DocumentoPF', 'EnderecoPF'],
	
	views: ['pessoafisica.PessoaFisicaPanel'],
	
    refs: [
        {
        	ref: 'PessoaFisicaGrid',
        	selector: 'pessoafisicagrid'
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
        },
        
        /*-- ContatoPF --*/
        {
        	ref: 'ContatoPFGrid',
        	selector: 'contatopfgrid'
        },
        {
        	ref: 'ContatoPFForm',
        	selector: 'contatopfform'
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
			
			/*-- Contato PF --*/
			'contatopfgrid button#addContatoPF': {
				click: this.novoContatoPF
			},
//			'contatopfgrid button#deleteContatoPF': {
//				click: this.delateContatoPF
//			},
//			'contatopfgrid': {
//				select: this.navegaContatoPF
//			},
			'contatopfform button#salvaContatoPF': {
				click: this.salvaContatoPF
			},
			'contatopfform button#cancelaContatoPF': {
				click: this.cancelaContatoPF
			},
			
			/*-- Documento PF --*/
//			'documentopfgrid': {
//				select: this.navegaDocumentoPF
//			},
//			'documentopfgrid button#addDocumentoPF': {
//				click: this.novoDocumentoPF
//			},
//			'documentopfgrid button#deleteDocumentoPF': {
//				click: this.deleteDocumentoPF
//			},
//			'documentopfform button#salvaDocumentoPF': {
//				click: this.salvaDocumentoPF
//			},
//			'documentopfform button#cancelaDocumentoPF': {
//				click: this.cancelaDocumentoPF
//			},
//			
//			/*-- Endereco PF --*/
//			'enderecopfgrid': {
//				select: this.navegaEnderecoPF
//			},
//			'enderecopfgrid button#addEnderecoPF': {
//				click: this.novoEnderecoPF
//			},
//			'enderecopdgrid button#deleteEnderecoPF': {
//				click: this.deleteEnderecoPF
//			},
//			'enderecopfform button#salvaEnderecoPF': {
//				click: this.salvaEnderecoPF
//			},
//			'enderecopfform button#cancelaEnderecoPF': {
//				click: this.cancelaEnderecoPF
//			}
			
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
			
			var store = Ext.getStore('ContatoPF');
			store.getProxy().setExtraParam( 'pessoafisicaid', record.get('id') );
			store.load();
			
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
		
		
	},
	
	
	/*-- Contato PF --*/
	novoContatoPF: function(btn, e, opts){
		
		if(this.getContatoPFForm()){
			this.getContatoPFForm().center();
			this.getContatoPFForm().down('form').getForm().reset();
		}else{
			var win = Ext.create('crm.view.pessoafisica.ContatoPFForm');
			
		}
		
	},
	
	salvaContatoPF: function(btn, e, opts){
		
		/*-- Pegando pessoa fisica selecionada --*/
		var pessoa = this.getPessoaFisicaGrid().getSelectionModel().getSelection();
		/*-- Pegando valores do formulario --*/
		var values = this.getContatoPFForm().down('form').getValues();
		/*-- Pegando a model caso haja --*/
		var records = this.getContatoPFForm().down('form').getRecord();
		/*-- Pega a Store --*/
		var store = Ext.getStore('ContatoPF');
		
		/*-- Validando Formulario --*/
		if( this.getContatoPFForm().down('form').getForm().isValid() ){
			
			/*-- Verificando se ID existe --*/
			if(values.id > 0){
				/*-- Seta os valores do formulario na model --*/
				records.set(values);
				/*-- Seta o ID da pessoa fisica selecionado --*/
				records.set('idpessoafisica', pessoa[0].get('id'));
				
			}else{
				
				/*-- Cria uma nova model --*/
				records = Ext.create('crm.model.ContatoPF');
				/*-- Seta os valores do Formulário na model --*/
				records.set(values);
				/*-- Seta o ID da pessoa fisica selecionado --*/
				records.set('idpessoafisica', pessoa[0].get('id'));
				
				/*-- Adiciona a Model na Store --*/
				store.add( records );
				
				
				
			}
			
			this.getContatoPFForm().down('form').getForm().reset();
			this.getContatoPFForm().close();
			/*-- Sincroniza a store --*/
			store.sync();
			store.load();
		}
		
	},
	
	cancelaContatoPF: function(btn, e, opts){
		
		this.getContatoPFForm().down('form').getForm().reset();
		this.getContatoPFForm().close();
		
	}
	
});