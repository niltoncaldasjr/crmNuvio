Ext.define('crm.controller.LogSistema',{
	extend: 'Ext.app.Controller',
	
	stores: ['LogSistema'],
	
	models: ['LogSistema'],
	
	views: ['logsistema.LogSistemaPanel'],
	
    refs: [
		{
		    ref: 'logPanel',
		    selector: 'logsistemapanel panel#sul'
		},
    	{
	        ref: 'logAntes',
	        selector: 'logsistemapanel panel#antes'
    	},
    	{
	        ref: 'logDepois',
	        selector: 'logsistemapanel panel#depois'
    	},
    	{
	        ref: 'logForm',
	        selector: 'logsistemapanel panel#formLog'
    	}
    ],
	
	init: function(){
		this.control({
			'logsistemagrid': {
				select: this.exibirDetalhes
			},
			'button#btnLog' :{
				click: this.editaLog
			}
		});
	},
	
	editaLog: function(btn, e, opts){
		var records = btn.up('panel').up('panel').down('grid').getSelectionModel().getSelection( )[0].getData() ;
		
		
		if(records['acao'] == 'EXCLUIR'){
			
		}else{
			var view = 'crm.view.'+records['class'].toLowerCase()+'.'+records['class']+'Form';
			
			view = Ext.create(view);
			
			var logForm = this.getLogForm();
			logForm.removeAll();
			logForm.add(view);

			logForm.show();
			logForm.expand(true);
			
			var store = Ext.getStore(records['class']);
			
			var model = store.findRecord( 'id', records['idregistro']);
			
			var form = view.down('form');
			
			var dock = view.down('toolbar');

			form.loadRecord(model);

			dock.removeAll();


			dock.add({
				xtype: 'button',
				text: 'Cancelar',
				iconCls: 'icon-reset',
				handler: function(){
					logForm.removeAll();
					// logForm.update('<div>Selecione um Log</div>');
					// logForm.collapse(false);
					logForm.hide();
					
				},
			},
			{
				xtype: 'button',
				text: 'Salvar',
				iconCls: 'icon-save',
				handler: function(btn){
					form.getRecord().set( form.getValues() );
					store.sync();

					logForm.removeAll();
					// logForm.update('<div>Selecione um Log</div>');
					// logForm.collapse(false);
					logForm.hide();
				}
			});

			// var btnSave = view.down('button#salva'+records['class']);
			// var btnCancel = view.down('button#cancela'+records['class']);

			// btnSave.setVisible(false);
			// btnSave.btnCancel(false);

		}
	},
	
	exibirDetalhes: function( linha, record, index, eOpts ){
		var log = record.get('id');
		
		
		/*-- Expandindo o Panel recolhido --*/
		this.getLogPanel().expand(true);
		
		/*-- Capturando Panel Antes e Depois --*/
		var antes = this.getLogAntes();
		var depois = this.getLogDepois();

		var objAntes = Ext.decode( record.get('antes' ) );
			
		var descAntes = '<tpl for=".">' +
                '<div class="patient-source"><table><tbody>';
        
		Ext.Object.each( objAntes, function(key, value, myself){
			if(Ext.isObject(value)){

		    	descAntes += '<tr><td class="patient-label">'+key+'</td><td class="patient-name">'+value['id']+'</td></tr>';
			
			}else{
				descAntes += '<tr><td class="patient-label">'+key+'</td><td class="patient-name">'+value+'</td></tr>';
				
			}
		}),

		descAntes += '</tbody></table></div>' +
             			'</tpl>';
		
		antes.update(  descAntes );

		var objDepois = Ext.decode( record.get('depois' ) );

		var descDepois = '<tpl for=".">' +
                '<div class="patient-source"><table><tbody>';
        
		Ext.Object.each( objAntes, function(key, value, myself){
		
			Ext.Object.each( objDepois, function(key2, value2, myself2){
				
				
				if(key == key2){
					
					if( Ext.isObject(value) ){
						
						if(value['id'] != value2['id'] && (key2 != 'datacadastro' && key2 != 'dataedicao')){
								descDepois += '<tr><td class="patient-label">'+key2+'</td><td class="patient-name2">'+value2['id']+'</td></tr>';
							}else{
								descDepois += '<tr><td class="patient-label">'+key2+'</td><td class="patient-name">'+value2['id']+'</td></tr>';
							}
						
					}else{
		
						
						if(value != value2 && (key2 != 'datacadastro' && key2 != 'dataedicao')){
							descDepois += '<tr><td class="patient-label">'+key2+'</td><td class="patient-name2">'+value2+'</td></tr>';
						}else{
							descDepois += '<tr><td class="patient-label">'+key2+'</td><td class="patient-name">'+value2+'</td></tr>';
						}
						
					}
				}
				
			});
			
		}),

		descDepois += '</tbody></table></div>' +
             			'</tpl>';
		
		depois.update(  descDepois );
		
		btn = this.getLogPanel().down('button');
		
		if(record.get('acao') == 'ALTERAR' || record.get('acao') == 'INCLUIR'){
			btn.setText('Editar');
		}else{
			btn.setText('Rowback');
		}

	}

	
});