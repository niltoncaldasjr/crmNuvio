Ext.define('crm.controller.Empresa', {
    extend: 'Ext.app.Controller',

    stores: ['Empresa'],

    models: ['Empresa'],

    views: ['empresa.EmpresaTab', 'empresa.EmpresaGrid', 'empresa.EmpresaPanel', 'crm.view.empresa.EmpresaFormulario'],

    refs: [{
        ref: 'empresaGrid',
        selector: 'empresagrid'
    },
    {
        ref: 'imagemEmpresa',
        selector: 'empresaformulario image'
    }
    ],

    init: function() {
        this.control({
            'empresagrid dataview': {
            	itemclick: this.onEditaEmpresa
            },
            'empresagrid': {
            	select: this.onEditaEmpresa
            },
            'empresagrid button#addEmpresa': {
            	click: this.onAddEmpresaClick
            },
            'empresagrid button#deleteEmpresa': {
                click: this.onDeleteEmpresaClick
            },
            'empresaformulario button#salvaempresa': {
                click: this.onSaveEmpresaClick
            },
            "empresaformulario filefield": {		// SALVAR DA TELA DE PROFILE
				change: this.onFilefieldChange
			},
            'empresaformulario button#cancelaempresa': {
                click: this.onCancelEmpresaClick
            }
        });
    },

    onEditaEmpresa: function(grid, record) {
    	var edit = Ext.ComponentQuery.query('empresatab')[0].expand(true);
    	Ext.ComponentQuery.query('empresaformulario')[0];        
        if(record){
        	edit.down('form').loadRecord(record);
        	if (record.get('imagemLogotipo')) { // #4
				var img = edit.down('form').down('image');
				img.setSrc('../libs/uploads/' + record.get('imagemLogotipo'));
			}
        }
    },
    onCancelEmpresaClick: function(btn, e, eOpts){
    	var panel = btn.up('panel').up('panel'),
    		form = btn.up('form');  
	    form.getForm().reset();
	    panel.collapse( false );
    },
    
    onAddEmpresaClick: function(btn, e, eOpts){
    	Ext.ComponentQuery.query('empresatab')[0].expand(true);
    	Ext.create('crm.view.empresa.EmpresaFormulario').show();
    },     
    
   onSaveEmpresaClick: function(btn, e, eOpts){
	   console.log('Clicou Save!!');
	   var panel = btn.up('panel').up('panel'),
		   form = panel.down('form'),
		   grid = Ext.ComponentQuery.query('empresagrid')[0],
		   store = grid.getStore();
	   
	if(form.isValid()){
		form.submit({
			url: 'rest/empresa/criar_atualizar.php',//			
			waitMsg: 'Enviando sua Logo...',
			success: function(tp, o){
				var result = o.result; 
				if (result.success) {
					store.load();
					form.getForm().reset();
					panel.collapse( false );
				}
			},
			failure: function(form, action) {
				console.log('erro');
				switch (action.failureType) {
					case Ext.form.action.Action.CLIENT_INVALID:
						Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
						break;
					case Ext.form.action.Action.CONNECT_FAILURE:
						Ext.Msg.alert('Failure', 'Ajax communication failed');
						break;
					case Ext.form.action.Action.SERVER_INVALID:
						Ext.Msg.alert('Failure', action.result.msg);
				}
			}	
		});
		}
   },
  
  onDeleteEmpresaClick: function(btn, e, eOpts){
  	Ext.MessageBox.confirm('Confirma', 'Deseja realmente deletar?', function(botton){			
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
  
  onFilefieldChange: function(filefield, value, options){
	  var file = filefield.fileInputEl.dom.files[0];
      var picture = this.getImagemEmpresa();
      if (typeof FileReader !== "undefined" && (/image/i).test(file.type)) {
          var reader = new FileReader();
          reader.onload = function(e){
              picture.setSrc(e.target.result);
          };
          reader.readAsDataURL(file); 
      } else if (!(/image/i).test(file.type)){
          Ext.Msg.alert('Alerta', 'Você só pode enviar imagens!');
          filefield.reset();
      }  
  }
  
});