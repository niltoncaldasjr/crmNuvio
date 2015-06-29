/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.controller.Main', {
    extend: 'Ext.app.Controller',
    
    requires: [
             	'cau.ux.CpfField',
             	'cau.ux.CnpjField'
    ],


    models: [
             	'cau.model.Pessoa',
             	'cau.model.EnderecoPF',
             	'cau.model.DocumentoPF',
             	'cau.model.ContatoPF',
             	'cau.model.CidadeModel',
             	'cau.model.TipoContatoModel',
             	'cau.model.OperadoraContatoModel'
    ],

    stores: [
             	'cau.store.PessoaStore',
             	'cau.store.EnderecoPFStore',
             	'cau.store.DocumentoPFStore',
             	'cau.store.ContatoPFStore',
             	'cau.store.CidadeStore',
             	'cau.store.TipoContatoStore',
             	'cau.store.OperadoraContatoStore'
    ],

    views: [
            	'cau.view.MenuPrincipal',
             	'cau.view.pessoa.PessoaForm',
                'cau.view.pessoa.PessoaGrid',
            	'cau.view.enderecopf.EnderecoPFForm',
                'cau.view.enderecopf.EnderecoPFGrid',
            	'cau.view.documentopf.DocumentoPFForm',
                'cau.view.documentopf.DocumentoPFGrid',            	
            	'cau.view.contatopf.ContatoPFForm',
            	'cau.view.contatopf.ContatoPFGrid'
    ],

    refs: [
          {
        	  ref: 'pessoaForm',
        	  selector: 'form'
          }
    ],
    
    init: function() {

        this.control({
            'pessoagrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady,
                render : this.onGridRender,
            },
            'enderecopfgrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady,
                render : this.onGridRender,
            },
            'contatopfgrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady,
                render : this.onGridRender,
            },
            'documentopfgrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady,
                render : this.onGridRender,
            },
            "pessoagrid button#add": {
                click : this.onAddClick
            },
            "enderecopfgrid button#addenderecopf": {
                click : this.onAddEnderecoPFClick
            },
            "contatopfgrid button#addcontatopf": {
                click : this.onAddContatoPFClick
            },
            "documentopfgrid button#adddocumentopf": {
                click : this.onAddDocumentoPFClick
            },
            "pessoagrid button#delete": {
                click : this.onDeleteClick
            },
            "pessoaform button#cancel": {
                click : this.onCancelClick
            },
            "pessoaform button#save": {
                click : this.onSaveClick
            },
            "pessoaform button#save2": {
                click : this.onSave2Click
            },
            "enderecopfform button#saveenderecopf":{
            	click : this.onSaveEnderecoPFClick
            },
            "enderecopfform button#cancelenderecopf":{
            	click : this.onCancelEnderecoClick
            },
            "enderecopfgrid button#deleteenderecopf":{
            	click: this.onDeleteEnderecoClick
            },
            "contatopfform button#savecontatopf":{
            	click : this.onSaveContatoPFClick
            },
            "contatopfform button#cancelcontatopf":{
            	click : this.onCancelContatoClick
            },
            "contatopfgrid button#deletecontatopf":{
            	click: this.onDeleteContatoClick
            },
            "documentopfform button#savedocumentopf":{
            	click : this.onSaveDocumentoPFClick
            },
            "documentopfform button#canceldocumentopf":{
            	click : this.onCancelDocumentoClick
            },
            "documentopfgrid button#deletedocumentopf":{
            	click: this.onDeleteDocumentoClick
            }
            
        });
    },

    onGridRender: function(grid, eOpts){
		grid.getStore().load();
	},

    openFormEnderecoPF: function(title){

        var win = Ext.create('cau.view.enderecopf.EnderecoPFForm');

        win.setTitle(title);

        return win;
    },

    openFormContatoPF: function(title){

        var win = Ext.create('cau.view.contatopf.ContatoPFForm');

        win.setTitle(title);

        return win;
    },
    
    openFormDocumentoPF: function(title){

        var win = Ext.create('cau.view.documentopf.DocumentoPFForm');

        win.setTitle(title);

        return win;
    },

    
    onAddEnderecoPFClick: function(btn, e, eOpts ){
        this.openFormEnderecoPF('Novo Endereço');
    },

    onAddContatoPFClick: function(btn, e, eOpts ){
        this.openFormContatoPF('Novo Contato');
    },

    onAddDocumentoPFClick: function(btn, e, eOpts ){
        this.openFormDocumentoPF('Novo Documento');
    },
    
    gridSelectionChange: function(model, records) {

        if (records[0]) {
             this.getPessoaForm().getForm().loadRecord(records[0]);
        }
    },
    
    onViewReady: function(grid) {
        grid.getSelectionModel().select(0);
    },
    
    onCancelClick: function(btn, e, eOpts){
        
    	this.getPessoaForm().getForm().reset();

    },

    onAddClick: function(btn, e, eOpts ){
        
    	this.getPessoaForm().getForm().reset();
    },

    onDeleteClick: function(btn, e, eOpts){
  
    	 Ext.MessageBox.confirm({
             title          : 'Aviso!'
             ,animateTarget : btn.el
             ,msg           : 'Deseja apagar esse registro(s)?'
             ,buttons       : Ext.MessageBox.YESNO
             ,icon          : 'icon-window-question'
             ,scope         : this
             ,fn            : function(button) {
                 if(button === 'yes') {
                	 var grid = btn.up('grid');
                   var records = grid.getSelectionModel().getSelection();
                   var store = grid.getStore();
                   store.remove(records);
                   store.sync();
                	 
                 }
             }
         });

    },

    onSaveClick: function(btn, e, eOpts){

        var form = this.getPessoaForm().getForm(),
            values = form.getValues(),
            record = form.getRecord(),
            grid = Ext.ComponentQuery.query('pessoagrid')[0],
            store = grid.getStore();

        if (record){ //edicao
            
            record.set(values);

        } else { //novo registro 

            var pessoa = Ext.create('cau.model.Pessoa',{
            	
            	nome: 			  	values.nome,
            	cpf: 				values.cpf,
            	dataNascimento:		values.dataNascimento,
            	enum_estadoCivil: 	values.enum_estadoCivil,
            	enum_sexo: 			values.enum_sexo,
            	nomePai:		 	values.nomePai,
            	nomeMae: 			values.nomeMae,
            	enum_cor: 			values.enum_cor,
            	naturalidade: 		values.naturalidade,
            	nacionalidade: 		values.nacionalidade
            });

            store.insert(0,pessoa);
        }

        grid.getView().refresh();
        store.sync();


    },    

    onSave2Click: function(btn, e, eOpts){

        var form = this.getPessoaForm().getForm(),
            values = form.getValues(),
            record = form.getRecord(),
            grid = Ext.ComponentQuery.query('pessoagrid')[0],
            store = grid.getStore();

        var pessoa = Ext.create('cau.model.Pessoa',{
        	
        	nome: 			  	values.nome,
        	cpf: 				values.cpf,
        	dataNascimento:		values.dataNascimento,
        	enum_estadoCivil: 	values.enum_estadoCivil,
        	enum_sexo: 			values.enum_sexo,
        	nomePai:		 	values.nomePai,
        	nomeMae: 			values.nomeMae,
        	enum_cor: 			values.enum_cor,
        	naturalidade: 		values.naturalidade,
        	nacionalidade: 		values.nacionalidade
        });

        store.insert(0,pessoa);

        store.sync();
        grid.getView().refresh();

    },    
    
    onSaveEnderecoPFClick: function(btn, e, eOpts){
    	
    	
    	var win = btn.up('window'),
        form = win.down('form'),
        values = form.getValues(),
        record = form.getRecord(),
        grid = Ext.ComponentQuery.query('enderecopfgrid')[0],
        store = grid.getStore();
    	
        
        if (record){ //edicao
            
            record.set(values);

        } else { //novo registro
        
        	var endereco = Ext.create('cau.model.EnderecoPF',{
        	
        		tipoEndereco: 	 values.tipoEndereco,
        		logradouro: 	 values.logradouro,
        		numero:		     values.numero,
        		complemento: 	 values.complemento,
        		bairro: 		 values.bairro,
        		cep:		 	 values.cep,
        		cidade: 		 values.cidade
        	});
        	
        	store.insert(0,endereco);
        	
        }
        
        store.sync();
        
        win.close();

    },
    
    onCancelEnderecoClick: function(btn, e, eOpts){
        
    	var win = btn.up('window');
    	
    	win.close();

    },

    onDeleteEnderecoClick: function(btn, e, eOpts){
  
    	 Ext.MessageBox.confirm({
             title          : 'Aviso!'
             ,animateTarget : btn.el
             ,msg           : 'Deseja apagar esse registro(s)?'
             ,buttons       : Ext.MessageBox.YESNO
             ,icon          : 'icon-window-question'
             ,scope         : this
             ,fn            : function(button) {
                 if(button === 'yes') {
                	 var grid = btn.up('grid');
                   var records = grid.getSelectionModel().getSelection();
                   var store = grid.getStore();
                   store.remove(records);
                   store.sync();
                	 
                 }
             }
         });

    },
    
    onSaveContatoPFClick: function(btn, e, eOpts){
    	
    	
    	var win = btn.up('window'),
        form = win.down('form'),
        values = form.getValues(),
        record = form.getRecord(),
        grid = Ext.ComponentQuery.query('contatopfgrid')[0],
        store = grid.getStore();
    	
        
        if (record){ //edicao
            
            record.set(values);

        } else { //novo registro
        
        	var contato = Ext.create('cau.model.ContatoPF',{
        	
        		id: 	     		values.id,
        		tipoContato: 		values.tipoContato,
        		operadoraContato:   values.operadoraContato,
        		contato: 	 		values.contato
        	});
        	
        	//console.log(values.id);
        	
        	store.insert(0,contato);
        	
        }
        
        store.sync();
        
        win.close();

    },
    
    onCancelContatoClick: function(btn, e, eOpts){
    	
    	var win = btn.up('window');
    	
    	win.close();

    },

    onDeleteContatoClick: function(btn, e, eOpts){
  
    	 Ext.MessageBox.confirm({
             title          : 'Aviso!'
             ,animateTarget : btn.el
             ,msg           : 'Deseja apagar esse registro(s)?'
             ,buttons       : Ext.MessageBox.YESNO
             ,icon          : 'icon-window-question'
             ,scope         : this
             ,fn            : function(button) {
                 if(button === 'yes') {
                	 var grid = btn.up('grid');
                   var records = grid.getSelectionModel().getSelection();
                   var store = grid.getStore();
                   store.remove(records);
                   store.sync();
                	 
                 }
             }
         });

    },
    
    onSaveDocumentoPFClick: function(btn, e, eOpts){
    	
    	
    	var win = btn.up('window'),
        form = win.down('form'),
        values = form.getValues(),
        record = form.getRecord(),
        grid = Ext.ComponentQuery.query('documentopfgrid')[0],
        store = grid.getStore();
    	
        
        if (record){ //edicao
            
            record.set(values);

        } else { //novo registro
        
        	var documento = Ext.create('cau.model.DocumentoPF',{
        	
        		id: 	       	values.id,
        		enum_tipo: 		values.enum_tipo,
        		numero:        	values.numero,
        		dataEmissao:   	values.dataEmissao,
        		orgaoEmissor:  	values.orgaoEmissor,
        		via:           	values.via
        		
        	});
        	        	
        	store.insert(0,documento);
        	
        }
        
        store.sync();
        
        win.close();

    },
    
    onCancelDocumentoClick: function(btn, e, eOpts){
    	
    	var win = btn.up('window');
    	
    	win.close();

    },

    onDeleteDocumentoClick: function(btn, e, eOpts){
    	 var grid = btn.up('grid');
         var records = grid.getSelectionModel().getSelection();
         if (records != null){
    	 Ext.MessageBox.confirm({
             title          : 'Aviso!'
             ,animateTarget : btn.el
             ,msg           : 'Deseja apagar esse registro(s)?'
             ,buttons       : Ext.MessageBox.YESNO
             ,icon          : 'icon-window-question'
             ,scope         : this
             ,fn            : function(button) {
                 if(button === 'yes') {
                	
                   var store = grid.getStore();
                   store.remove(records);
                   store.sync();
                	 
                 }
             }
         });
         }

    }
    
    
});
