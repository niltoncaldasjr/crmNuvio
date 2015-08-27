Ext.define('crm.controller.Usuario',{
	extend: 'Ext.app.Controller',
	
	stores: ['Usuario','Rotina','UsuarioRotina'],
	
	models: ['Usuario','Rotina'],
	
	views: ['usuario.UsuarioPanel','crm.view.usuariorotina.UsuarioRotinaPanel'],
	
    refs: [
    	{
	        ref: 'usuarioGrid',
	        selector: 'usuariogrid'
    	},
    	{
	    	ref: 'usuarioRotinaGrid',
	    	selector: 'usuariorotinagrid'
	    },
	    {
	    	ref: 'rotinaListaGrid',
	    	selector: 'rotinalistagrid'
	    },
    	{
            ref: 'TabPanel',
            selector: 'usuariotabpanel'
        },
    	{
            ref: 'Form',
            selector: 'usuarioform form'
        },
        {
            ref: 'PanelOeste',
            selector: 'usuariopanel panel#oeste'
        },
        {
            ref: 'PanelSul',
            selector: 'usuariopanel panel#sul'
        }
    	
    ],
	
	init: function(){
		this.control({
			'usuariogrid':  {
				select: this.editarUsuario,
			},
			'usuariogrid button#addUsuario': {
				click: this.novoUsuario
			},
			'usuariogrid button#deleteUsuario': {
				click: this.deleteUsuario
			},
			'menu#posformusuario menuitem': {
				click: this.posicaoForm
			},
			'usuarioform button#salvausuario': {
				click: this.updateUsuario
			},
			'usuarioform button#cancelausuario': {
				click: this.cancelaUsuario
			},
			
			'rotinalistagrid > gridview': {
				drop : this.SalvaUsuarioRotina
			},
			/*-- Quando um item for Dropado na Grid EmpresaUsuario--*/
			//- PS: Usar este sinal de > para quando desejar pegar eventos de um Plugin
			//- que está sendo usado no componente
			'usuariorotinagrid > gridview': {
				drop : this.DeletaUsuarioRotina
			}
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

	novoUsuario: function(){
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
	
	editarUsuario: function(grid, record) {
		
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
		}
		/********************** inicio ***********************/
		
//		/*-- Capturando o Id do usuario selecionado --*/
		idusuario = record.get('id');
//		/*-- Capturando a Store da Grid de EmpresaUsuario --*/
		UsuarioRotinaStore = this.getUsuarioRotinaGrid().getStore();
		
//		/*-- Capturando a Store da Grid de EmpresaLista --*/
		
		RotinaListaStore = this.getRotinaListaGrid().getStore();
		
		Ext.Ajax.request({
			url: 'php/usuariorotina/lista.php',
			params: {
				idusuario: idusuario,
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
				UsuarioRotinaStore.removeAll();
				UsuarioRotinaStore.addSorted(result.data);
				
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
		/** fim **/
	},
	
	updateUsuario: function(button){
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
				record = Ext.create('crm.model.Usuario');
				record.set(values);
				this.getUsuarioStore().add(record);
				novo = true;
			}
			this.getUsuarioStore().sync();
			
			/*-- Se o novo for true da reload na grid para atualizar a lista --*/
			if(novo){
				this.getUsuarioStore().load();
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
	
	deleteUsuario: function(btn, e, opts){
		
		var form = this.getForm();

		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){			
			if(botton == 'yes'){
				
				var grid = btn.up('grid'),
	    		records = grid.getSelectionModel().getSelection(),
	    		store = grid.getStore();				
				
				form.getForm().reset();
	    	
	    		store.remove(records);
		    	store.sync();
		    	
			}
			else if(botton == 'no'){
				return false;
			}
		});  	
		
	},
	
	cancelaUsuario: function(button){
		
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
	
	/*-- Metodo Drop quando um item é solto na Grid EmpresaListaGrid --*/
	SalvaUsuarioRotina: function(node, data, dropRec, dropPosition) {
    	// console.log(data.records.length);

    	/*-- 
    		Chama o metodo de Cadastro e Delete 
			- passamos o records do data onde estão os valores movidos
			- passamos o metodo delete(Deletar)
    	--*/
		this.PostDeleteDrop(data.records, 'delete');
    },

    /*-- Metodo Drop quando um item é solto na Grid EmpresaUsuarioGrid --*/
    DeletaUsuarioRotina: function(node, data, dropRec, dropPosition) {
    	
    	/*-- 
    		Chama o metodo de Cadastro e Delete 
			- passamos o records do data onde estão os valores movidos
			- passamos o metodo post(Cadastrar)
    	--*/
		this.PostDeleteDrop(data.records, 'post');
    },

    /*-- Cadastra/Deleta EmpresaUsuario --*/
    PostDeleteDrop: function(data, metodo){
    	// console.log(data);

    	/*-- Capturamos o Usuário selecionado na *UsuarioListaGrid* --*/
    	var usuario = this.getUsuarioGrid().getSelectionModel().getSelection();

    	if(usuario[0])
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
					idusuario : usuario[0].get('id')
				};
	    	}

	    	/*-- encodamos para Json --*/
	    	dados = Ext.encode ( dados ) ;

	    	// console.log(dados);

	    	/*-- Iniciamos o Ajax do Ext --*/
	    	Ext.Ajax.request({

	    		/*-- Passamos por parametro(GET) o metodo(Post/Delete) --*/
				url: 'php/usuariorotina/salvadeleta.php?metodo='+metodo,
				params: {
					/*-- Passamos na chave *data* o array *dados* --*/
					data: dados,
				}
			
			});
	    }
    },
	
});

//Ext.define('crm.controller.Usuario', {
//    extend: 'Ext.app.Controller',
//
//    stores: ['Usuario'],
//
//    models: ['Usuario'],
//
//    views: ['usuario.UsuarioForm', 'usuario.UsuarioGrid'],
//
//    refs: [{
//        ref: 'usuarioGrid',
//        selector: 'grid'
//    }
//    ],
//
//    init: function() {
//        this.control({
//            'usuariogrid dataview': {
//                itemdblclick: this.onEditaUsuario
//            },
//            'usuariogrid button#addUsuario': {
//            	click: this.onAddUsuarioClick
//            },
//            'usuariogrid button#deleteUsuario': {
//                click: this.onDeleteUsuarioClick
//            },
//            'usuarioform button#salvausuario': {
//                click: this.onSaveUsuarioClick
//            },
//            'usuarioform button#cancelausuario': {
//                click: this.onCancelUsuarioClick
//            }
//        });
//    },
//
//    onEditaUsuario: function(grid, record) {
//        var edit = Ext.create('crm.view.usuario.UsuarioForm').show();        
//        if(record){
//        	edit.down('form').loadRecord(record);
//        }
//    },
//    onCancelUsuarioClick: function(btn, e, eOpts){
//    	var win = btn.up('window');
//    	var form = win.down('form');
//    	form.getForm().reset();
//    	win.close();
//    },
//    onAddUsuarioClick: function(btn, e, eOpts){
//    	Ext.create('crm.view.usuario.UsuarioForm').show();
//    }, 
//
//    
//    onSaveUsuarioClick: function(btn, e, eOpts){
//    	var win = btn.up('window'),
//    		form = win.down('form'),
//    		values = form.getValues(),
//    		record = form.getRecord(),
//    		grid = Ext.ComponentQuery.query('usuariogrid')[0],
//    		store = grid.getStore();
//    	if(form.isValid()){
//	    	if (values.id > 0){
//				record.set(values);
//	    		
//	    	} else{   // se for um novo
//	    		record = Ext.create('crm.model.Usuario');
//	    		record.set(values);
//	    		store.add(record);
//	    	}
//	    	win.close();
//	        store.sync();
//	    	store.load();
//    	}
//  },
//  
//  onDeleteUsuarioClick: function(btn, e, eOpts){
//  	Ext.MessageBox.confirm('Confirmar', 'Deseja deletar?', function(botton){			
//			if(botton == 'yes'){
//				var grid = btn.up('grid'),
//	    		records = grid.getSelectionModel().getSelection(),
//	    		store = grid.getStore();
//	    	
//		    	store.remove(records);
//		    	store.sync();
//		    	
//			}
//			else if(botton == 'no'){
//				return false;
//			}
//		});  	
//  }  
//  
//});
