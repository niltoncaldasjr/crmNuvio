/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.controller.Main', {
    extend: 'Ext.app.Controller',
    
    requires: [
             	'crm.ux.CpfField',
             	'crm.ux.CnpjField'
    ],


    models: [
             	'crm.model.Pais'
    ],

    stores: [
             	'crm.store.Pais'
    ],

    views: [
            	//'crm.view.MenuPrincipal',
             	'crm.view.pais.PaisForm',
                'cau.view.pais.PaisGrid'
    ],

    refs: [
          {
        	  ref: 'paisForm',
        	  selector: 'form'
          }
    ],
    
    init: function() {

        this.control({
            'paisgrid': {
                selectionchange: this.gridSelectionChange,
                viewready: this.onViewReady,
                render : this.onGridRender,
            },
            "paisgrid button#addPais": {
                click : this.onAddClick
            },
            "paisgrid button#deletePais": {
                click : this.onDeleteClick
            },
            "paisform button#cancelapais": {
                click : this.onCancelClick
            },
            "paisform button#salvapais": {
                click : this.onSaveClick
            }
            
        });
    },

    onGridRender: function(grid, eOpts){
		grid.getStore().load();
	},

    openFormPais: function(title){

        var win = Ext.create('crm.view.pais.PaisForm');

        win.setTitle(title);

        return win;
    },

    onAddClick: function(btn, e, eOpts ){
        this.openFormPais('Novo Pais');
    },

    gridSelectionChange: function(model, records) {

        if (records[0]) {
             this.getPaisForm().getForm().loadRecord(records[0]);
        }
    },
    
    onViewReady: function(grid) {
        grid.getSelectionModel().select(0);
    },
    
    onCancelClick: function(btn, e, eOpts){
        
    	this.getPaisForm().getForm().reset();

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

        var form = this.getPaisForm().getForm(),
            values = form.getValues(),
            record = form.getRecord(),
            grid = Ext.ComponentQuery.query('paisgrid')[0],
            store = grid.getStore();

        if (record){ //edicao
            
            record.set(values);

        } else { //novo registro 

            var pessoa = Ext.create('crm.model.Pais',{
            	
            	descricao: 			  	values.descricao,
            	nacionalidade: 		values.nacionalidade
            });

            store.insert(0,pessoa);
        }

        grid.getView().refresh();
        store.sync();


    }    

    
    
});
