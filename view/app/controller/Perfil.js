Ext.define('crm.controller.Perfil', {
    extend: 'Ext.app.Controller',

    stores: ['Perfil', 'PerfilRotina'],

    models: ['Perfil'],

    views: ['perfil.PerfilForm', 'perfil.PerfilGrid', 'perfil.PerfilRotinaPanel', 'perfil.PerfilRotinaGrid', 'perfil.Rotinas'],

   
    refs: [
   	    {
   	    	ref: 'perfilRotinaGrid',
   	    	selector: 'perfilrotinagrid'
   	    },
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
            'rotinas > gridview': {
				drop : this.SalvaPerfilRotina
			},
			'perfilrotinagrid > gridview': {
				drop : this.DeletaPerfilRotina
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
            }
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
		
//		/*-- Capturando o Id do usuario selecionado --*/
		idperfil = record.get('id');
//		/*-- Capturando a Store da Grid de EmpresaUsuario --*/
		PerfilRotinaStore = this.getPerfilRotinaGrid().getStore();
		
//		/*-- Capturando a Store da Grid de EmpresaLista --*/
		RotinaListaStore = this.getRotinas().getStore();
		
		Ext.Ajax.request({
			url: 'php/perfilRotina/lista.php',
			params: {
				idperfil: idperfil,
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
				PerfilRotinaStore.removeAll();
				PerfilRotinaStore.addSorted(result.data);				
				
				RotinaListaStore.removeAll();
				RotinaListaStore.add(result.data2);
				
				
			} else {
				Ext.Msg.show({ 
					title:'Fail!',
					msg: result.msg, 
					icon: Ext.Msg.ERROR,
					buttons: Ext.Msg.OK
				});
			}
		},			
	});
  },
  
  PostDeleteDrop: function(data, metodo){
  	// console.log(data);

  	/*-- Capturamos o Usuário selecionado na *UsuarioListaGrid* --*/
  	var perfil = this.getPerfilGrid().getSelectionModel().getSelection();

  	if(perfil[0])
  	{
	    	/*-- Contamos a quantidade de items(empresas) movidos --*/
	    	var total = data.length;
	    	/*-- Array de dados --*/
	    	var dados =[];

	    	/*-- Laço adicionando todos os dados ao Array --*/
	    	for(i = 0; i < total; i++)
	    	{
	    		/* Adição de cada empresa em uma posição + id do usuario selecionado */
				dados[i] = { 
					idrotina : data[i].get('id'),
					idperfil : perfil[0].get('id')
				};
	    	}

	    	/*-- encodamos para Json --*/
	    	dados = Ext.encode ( dados ) ;

	    	// console.log(dados);

	    	/*-- Iniciamos o Ajax do Ext --*/
	    	Ext.Ajax.request({

	    		/*-- Passamos por parametro(GET) o metodo(Post/Delete) --*/
				url: 'php/perfilRotina/salvadeleta.php?metodo='+metodo,
				params: {
					/*-- Passamos na chave *data* o array *dados* --*/
					data: dados,
				}
			
			});
	    }
  },
  
  SalvaPerfilRotina: function(node, data, dropRec, dropPosition) {
  	// console.log(data.records.length);

  	/*-- 
  		Chama o metodo de Cadastro e Delete 
			- passamos o records do data onde estão os valores movidos
			- passamos o metodo delete(Deletar)
  	--*/
		this.PostDeleteDrop(data.records, 'delete');
  },
  
  DeletaPerfilRotina: function(node, data, dropRec, dropPosition) {
  	
  	/*-- 
  		Chama o metodo de Cadastro e Delete 
			- passamos o records do data onde estão os valores movidos
			- passamos o metodo post(Cadastrar)
  	--*/
		this.PostDeleteDrop(data.records, 'post');
  }
  
  
});
