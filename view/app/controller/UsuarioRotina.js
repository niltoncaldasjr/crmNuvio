Ext.define('crm.controller.UsuarioRotina',{
	extend: 'Ext.app.Controller',
	
	models: ['Rotina'],
	
	stores: ['UsuarioRotina'],
	
	views: ['crm.view.usuariorotina.UsuarioRotinaPanel'],
	
	refs: [
	    {
	    	ref: 'usuarioRotinaGrid',
	    	selector: 'usuariorotinagrid'
	    },
	    {
	    	ref: 'rotinaListaGrid',
	    	selector: 'rotinalistagrid'
	    },
	    {
	    	ref: 'listaUsuarioGrid',
	    	selector: 'listausuariogrid'
	    }
	],
	
	init: function(){
		this.control({
			/*-- Quando um item for selecionado na Grid de Usuario --*/
			'listausuariogrid': {
				select: this.onSelect
			},
			/*-- Quando um item for Dropado na Grid EmpresaLista--*/
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
    	var usuario = this.getListaUsuarioGrid().getSelectionModel().getSelection();

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

    /*-- Metodo para quando um item é selecionado na Grid --*/
	onSelect: function( linha, record, index, eOpts ){
		//console.log(record.get('id'));
		
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
	}
});