Ext.define('crm.controller.Perfil', {
    extend: 'Ext.app.Controller',

    requires: ['Ext.ux.CheckColumn', 'crm.util.Alert'],
    
    stores: ['Perfil', 'PerfilRotina'],

    models: ['Perfil','PerfilRotina'],

    views: ['perfil.PerfilForm', 'perfil.PerfilRotinaEdicao', 'perfil.PerfilGrid', 'perfil.PerfilRotinaPanel', 'perfil.PerfilRotinaGrid', 'perfil.Rotinas','crm.view.perfilrotina.ListaPFGrid'],

   
    refs: [
//   	    {
//   	    	ref: 'adicionarRotina',
//   	    	selector: 'rotinas button#adicionarRotina'
//   	    },
   	    {
   	    	ref: 'rotinas',
   	    	selector: 'rotinas'
   	    },
   	    {
            ref: 'Form',
            selector: 'perfilform form'
        },
   	    {
   	    	ref: 'perfilGrid',
            selector: 'perfilgrid'
   	    },
//   	    {
//   	    	ref: 'perfilRotinaEdicao',
//   	    	selector: 'perfilrotinaedicao'
//   	    },
   	    {
   	    	ref: 'listaPFGrid',
   	    	selector: 'listapfgrid'
   	    }
   	],
   	
    init: function() {
        this.control({
            'perfilgrid dataview': {
                itemdblclick: this.onEditaPerfil
            },
            
            'perfilgrid': {
            	select: this.onSelect
            },
            'rotinas button#adicionarRotina': {
				click : this.adicionarPerfilRotina
			},
			'listapfgrid button#excluirRotina': {
				click : this.excluirPerfilRotina
			},
            'perfilgrid button#addPerfil': {
            	click: this.onAddPerfilClick
            },
            'perfilgrid button#deletePerfil': {
                click: this.onDeletePerfilClick
            },
            'perfilform button#salvaperfil': {
                click: this.onSavePerfilClick
            },
            'perfilform button#cancelaperfil': {
                click: this.onCancelPerfilClick
            },
            'listapfgrid checkcolumn':{
            	checkchange: this.onCheckedConsulta
            }
//            'perfilrotinagrid dataview':{
//            	itemdblclick: this.onAbrirEdicao
//            }
        });
    },

    onEditaPerfil: function(grid, record) {
        var edit = Ext.create('crm.view.perfil.PerfilForm').show();
        console.log('Botão Adds Form');
        if(record){
        	edit.down('form').loadRecord(record);
        }
    },
    onCancelPerfilClick: function(btn, e, eOpts){
    	var win = btn.up('window');
    	var form = win.down('form');
    	form.getForm().reset();
    	win.close();
    },
    onAddPerfilClick: function(btn, e, eOpts){
    	Ext.create('crm.view.perfil.PerfilForm').show();
    }, 

    
    onSavePerfilClick: function(btn, e, eOpts){
    	var win = btn.up('window'),
    		form = win.down('form'),
    		values = form.getValues(),
    		record = form.getRecord(),
    		grid = Ext.ComponentQuery.query('perfilgrid')[0],
    		store = grid.getStore();
    	if(form.isValid()){
	    	if (values.id > 0){
				record.set(values);
	    		
	    	} else{   // se for um novo
	    		record = Ext.create('crm.model.Perfil');
	    		record.set(values);
	    		store.add(record);
	    	}
	    	win.close();
	        store.sync();
	    	store.load();
    	}
  },
  
  onDeletePerfilClick: function(btn, e, eOpts){
	
	  var form = this.getForm();
	  
  	Ext.MessageBox.confirm('Confirma', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();
	    	
				var StoreUsuario = Ext.getStore('Usuario');
				modelUsuario = StoreUsuario.findRecord('idperfil', records[0].get('id'));
				
				var StorePerfilRotina = Ext.getStore('PerfilRotina');
				modelPerfilRotina = StorePerfilRotina.findRecord('idperfil', records[0].get('id'));
				
				if(modelUsuario || modelPerfilRotina){
					
					Ext.Msg.show({
						title : 'Atenção!',
						msg : "Dados não podem ser excluídos pois existem dependentes!",
						icon : Ext.Msg.ERROR,
						buttons : Ext.Msg.OK
					});
					
				}else{
					if(form){
						form.getForm().reset();
					}
				    store.remove(records);
				    store.sync();
				    	
				}
		    	
			}
			else if(botton == 'no'){
				return false;
			}
		});
  	
  },
  
  onSelect: function( linha, record, index, eOpts ){
		//console.log(record.get('id'));
	  	pr_store = this.getListaPFGrid().getStore();
	  	r_store  = this.getRotinas().getStore();
//		/*-- Capturando o Id do usuario selecionado --*/
		id = record.get('id');
		Ext.Ajax.request({
			url: 'php/perfilRotina/listarrotinas.php',
			params: {
				idperfil: id,
		},
		failure: function(conn, response, options, eOpts) {
			Ext.Msg.show({
				title:'Error!',
				msg: conn.responseText,
				icon: Ext.Msg.ERROR,
				buttons: Ext.Msg.OK
			});
		},
		success: function(conn, response, options, eOpts) {
			var result = Ext.JSON.decode(conn.responseText, true); 
			if (!result){ 
				result = {};
				result.success = false;
				result.msg = conn.responseText;
			}
			if (result.success) { 
				//dados carrega dados na grid
				pr_store.removeAll();
				pr_store.add(result.data);
				
				r_store.removeAll();
				r_store.add(result.rotinas);
			} else {
				Ext.Msg.show({ 
					title:'FaiÔOOOO!',
					msg: result.msg, 
					icon: Ext.Msg.ERROR,
					buttons: Ext.Msg.OK
				});
			}
		},			
	});
  },
  
  onCheckedConsulta: function(grid, rowIndex, checked, eOpts ){
		  var store = this.getListaPFGrid().getStore();		  
		  model = store.getAt(rowIndex);
		  
		  model = Ext.encode(model['data']);
		  Ext.Ajax.request({
				url: 'php/perfilRotina/alteracao.php',
				params: {
					data: model
			},
			
			});
		  store.sync();	  
  },
  
  adicionarPerfilRotina: function(btn, e, eOpts){
	  metodo = "post";
	  perfil = this.getPerfilGrid().getSelectionModel().getSelection();
	  rotinas = this.getRotinas().getSelectionModel().getSelection();
	  if(perfil[0])
	  	{
		    	/*-- Contamos a quantidade de items(empresas) movidos --*/
		    	var total = rotinas.length;
		    	/*-- Array de dados --*/
		    	var dados =[];
	
		    	/*-- Laço adicionando todos os dados ao Array --*/
		    	for(i = 0; i < total; i++)
		    	{
		    		/* Adição de cada empresa em uma posição + id do usuario selecionado */
					dados[i] = { 
						idrotina : rotinas[i].get('id'),
						idperfil : perfil[0].get('id')
					};
		    	}
	
		    	/*-- encodamos para Json --*/
		    	dados = Ext.encode ( dados ) ;
	
		    	 console.log(dados);
		    	 
		    	 Ext.Ajax.request({
	 				url: 'php/perfilRotina/salvadeleta.php?metodo='+metodo,
	 				params: {
	 					/*-- Passamos na chave *data* o array *dados* --*/
	 					data: dados,
	 				},
	 				failure: function(conn, response, options, eOpts) {
	 					Ext.Msg.show({
	 						title:'Error!',
	 						msg: conn.responseText,
	 						icon: Ext.Msg.ERROR,
	 						buttons: Ext.Msg.OK
	 					});
	 				},
	 				success: function(conn, response, options, eOpts) {
	 					var result = Ext.JSON.decode(conn.responseText, true); 
	 					if (!result){ 
	 						result = {};
	 						result.success = false;
	 						result.msg = conn.responseText;
	 					}
	 					if (result.success) { 
	 						//dados carrega dados na grid
	 						pr_store.removeAll();
	 						pr_store.add(result.data);
	 						pr_store.sync();
	 						
	 						r_store.removeAll();
	 						r_store.add(result.rotinas);
	 					} else {
	 						Ext.Msg.show({ 
	 							title:'Falhou no metodo add!',
	 							msg: result.msg, 
	 							icon: Ext.Msg.ERROR,
	 							buttons: Ext.Msg.OK
	 						});
	 					}
	 				},	
	 			});
		    	 
	  	}
  },
  
  excluirPerfilRotina: function(btn, e, eOpts){
	  metodo = "delete";
	  perfilrotina = this.getListaPFGrid().getSelectionModel().getSelection();
	  console.log(perfilrotina);
	  if(perfilrotina[0])
	  	{
//		    	/*-- Contamos a quantidade de items(empresas) movidos --*/
//		    	var total = rotinas.length;
//		    	/*-- Array de dados --*/
//		    	var dados =[];
//	
//		    	/*-- Laço adicionando todos os dados ao Array --*/
//		    	for(i = 0; i < total; i++)
//		    	{
//		    		/* Adição de cada empresa em uma posição + id do usuario selecionado */
//					dados[i] = { 
//						idrotina : rotinas[i].get('id'),
//						idperfil : perfil[0].get('id')
//					};
//		    	}
//		  		var dados =[];
//		  		dados = perfilrotina[0]
		    	/*-- encodamos para Json --*/
		    	dados = Ext.encode ( perfilrotina ) ;
	
		    	 console.log(dados);
		    	 
		    	 Ext.Ajax.request({
	 				url: 'php/perfilRotina/salvadeleta.php?metodo='+metodo,
	 				params: {
	 					/*-- Passamos na chave *data* o array *dados* --*/
	 					data: dados,
	 				},
	 				failure: function(conn, response, options, eOpts) {
	 					Ext.Msg.show({
	 						title:'Error!',
	 						msg: conn.responseText,
	 						icon: Ext.Msg.ERROR,
	 						buttons: Ext.Msg.OK
	 					});
	 				},
	 				success: function(conn, response, options, eOpts) {
	 					var result = Ext.JSON.decode(conn.responseText, true); 
	 					if (!result){ 
	 						result = {};
	 						result.success = false;
	 						result.msg = conn.responseText;
	 					}
	 					if (result.success) { 
	 						//dados carrega dados na grid
	 						pr_store.removeAll();
	 						pr_store.add(result.data);
	 						pr_store.sync();
	 						
	 						r_store.removeAll();
	 						r_store.add(result.rotinas);
	 					} else {
	 						Ext.Msg.show({ 
	 							title:'Falhou no metodo add!',
	 							msg: result.msg, 
	 							icon: Ext.Msg.ERROR,
	 							buttons: Ext.Msg.OK
	 						});
	 					}
	 				},	
	 			});
		    	 
	  	}
	  
  }
  

  
});
