Ext.define('crm.controller.LogSistema',{
	extend: 'Ext.app.Controller',
	
	stores: ['LogSistema'],
	
	models: ['LogSistema'],
	
	views: ['logsistema.LogSistemaPanel' , 'MainPanel'],
	
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
    	},
    	{
	        ref: 'mainPanel',
	        selector: 'mainpanel'
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
			var mainPanel = this.getMainPanel();

			var view = 'crm.view.'+records['class'].toLowerCase()+'.'+records['class']+'Form';
			
			requires: [view];
			
			view = Ext.create(view);
			
			this.getLogForm().removeAll();
			this.getLogForm().add(view);
			
			var store = Ext.getStore(records['class']);
			
			var model = store.findRecord( 'id', records['idregistro']);
			
			var form = view.down('form');
			
			form.loadRecord(model)
			
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
				Ext.each( key, function(val){
					descAntes += '<tr><td class="patient-label">'+key+'</td><td class="patient-name">'+val+'</td></tr>';
				});
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
        
		Ext.Object.each( objDepois, function(key, value, myself){
			if(Ext.isObject(value)){
				Ext.each( key, function(val){
					descDepois += '<tr><td class="patient-label">'+key+'</td><td class="patient-name">'+val+'</td></tr>';
				});
			}else{
				descDepois += '<tr><td class="patient-label">'+key+'</td><td class="patient-name">'+value+'</td></tr>';
				
			}
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