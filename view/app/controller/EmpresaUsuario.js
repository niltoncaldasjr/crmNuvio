Ext.define('crm.controller.EmpresaUsuario',{
	extend: 'Ext.app.Controller',
	
	models: ['Empresa'],
	
	stores: ['EmpresaUsuario'],
	
	views: ['crm.view.empresausuario.EmpresaUsuarioPanel'],
	
	refs: [
	    {
	    	ref: 'empresaUsuarioGrid',
	    	selector: 'empresausuariogrid'
	    },
	    {
	    	ref: 'empresaListaGrid',
	    	selector: 'empresalistagrid'
	    },
	    {
	    	ref: 'usuarioListaGrid',
	    	selector: 'usuariolistagrid'
	    }
	],
	
	init: function(){
		this.control({
			/*-- Quando um item for selecionado na Grid de Usuario --*/
			'usuariolistagrid': {
				select: this.onSelect
			},
			/*-- Quando um item for Dropado na Grid EmpresaLista--*/
			'empresalistagrid > gridview': {
				drop : this.SalvaEmpresaUsuario
			},
			/*-- Quando um item for Dropado na Grid EmpresaUsuario--*/
			//- PS: Usar este sinal de > para quando desejar pegar eventos de um Plugin
			//- que está sendo usado no componente
			'empresausuariogrid > gridview': {
				drop : this.DeletaEmpresaUsuario
			}
		});
	},

	/*-- Metodo Drop quando um item é solto na Grid EmpresaListaGrid --*/
	SalvaEmpresaUsuario: function(node, data, dropRec, dropPosition) {
    	// console.log(data.records.length);

    	/*-- 
    		Chama o metodo de Cadastro e Delete 
			- passamos o records do data onde estão os valores movidos
			- passamos o metodo delete(Deletar)
    	--*/
		this.PostDeleteDrop(data.records, 'delete');
    },

    /*-- Metodo Drop quando um item é solto na Grid EmpresaUsuarioGrid --*/
    DeletaEmpresaUsuario: function(node, data, dropRec, dropPosition) {
    	
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
    	var usuario = this.getUsuarioListaGrid().getSelectionModel().getSelection();

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
					idempresa : data[i].get('id'),
					idusuario : usuario[0].get('id')
				};
	    	}

	    	/*-- encodamos para Json --*/
	    	dados = Ext.encode ( dados ) ;

	    	// console.log(dados);

	    	/*-- Iniciamos o Ajax do Ext --*/
	    	Ext.Ajax.request({

	    		/*-- Passamos por parametro(GET) o metodo(Post/Delete) --*/
				url: 'php/empresausuario/salvadeleta.php?metodo='+metodo,
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
		
		/*-- Capturando o Id do usuario selecionado --*/
		idusuario = record.get('id');
		/*-- Capturando a Store da Grid de EmpresaUsuario --*/
		EmpresaUsuarioStore = this.getEmpresaUsuarioGrid().getStore();
		/*-- Capturando a Store da Grid de EmpresaLista --*/
		EmpresaListaStore = this.getEmpresaListaGrid().getStore();
		
		Ext.Ajax.request({
			url: 'php/empresausuario/lista.php',
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
				EmpresaUsuarioStore.removeAll();
				EmpresaUsuarioStore.addSorted(result.data);
				
				EmpresaListaStore.removeAll();
				EmpresaListaStore.add(result.data2);
				
				
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