Ext.define('crm.controller.SelecaoEmpresa', {
	extend : 'Ext.app.Controller',

	stores : [ 'SelecaoEmpresa' ],

	models : [ 'selecaoempresa.SelecaoEmpresa' ],

	views : [ 'SelecaoEmpresa.SelecaoEmpresa', 'SelecaoEmpresa.IconEmpresa' ],

	// ref: [{
	// ref: 'selecaoempresa',
	// selector: 'window'
	// }],

	init : function(application) {
		this.control({
			"iconempresa" : {
				selectionchange : this.onIconSelect,
				itemdblclick : this.fireImageSelected,
				render : this.onPanelRender
			},
			"selecaoempresa button#okselecaoempresa" : {
				click : this.fireImageSelected
			},
			"selecaoempresa button#cancelselecaoempresa" : {
				click : this.restartSystem
			}

		});
	},

	onPanelRender : function(component, options) {
		component.getStore().load();
	},

	onIconSelect : function(dataview, selections) {
		var selected = selections[0];

		if (selected) {
			Ext.ComponentQuery.query('infopanelempresa')[0]
					.loadRecord(selected);
		}
	},

	/**
	 * Fires the 'selected' event, informing other components that an image has
	 * been selected
	 */
	fireImageSelected : function() {
		var win = Ext.ComponentQuery.query('selecaoempresa')[0];

		var selectedImage = win.down('iconempresa').selModel.getSelection()[0];

		if (selectedImage) {

			// console.log("ID Empresa: "+selectedImage.get('id'));

			var idempresa = selectedImage.get('id');

			/*-- Abrindo a Session da Empresa do usuario --*/
			Ext.Ajax.request({
				url : 'php/StartSessionEmpresa.php',
				params : {
					idempresa : idempresa
				},
				/*-- Caso ocorra uma falha no Ajax --*/
				failure : function(conn, response, options, eOpts) {
					// Ext.get(panel.getEl()).unmask();
					Ext.Msg.show({
						title : 'Ops!',
						msg : conn.responseText,
						icon : Ext.Msg.ERROR,
						buttons : Ext.Msg.OK
					});
				},
				/*-- Caso ocorra sucesso na Requisição Ajax --*/
				success : function(conn, response, options, eOpts) {
					// Ext.get(panel.getEl()).unmask();
					var result = Ext.JSON.decode(conn.responseText, true);
					if (!result) {
						result = {};
						result.success = false;
						result.msg = conn.responseText;
					}
					if (result.success) {

						win.close();

						Ext.create('crm.view.MyViewport');

					} else {
						Ext.Msg.show({
							title : 'Fail!',
							msg : result.msg,
							icon : Ext.Msg.ERROR,
							buttons : Ext.Msg.OK
						});
					}
				},
			});

			// win.close();
			//          
			// Ext.create('crm.view.MyViewport');
		} else {
			// Ext.MessageBox.alert('Alerta','Selecione uma empresa!!!');
			Ext.Msg.show({
				title : 'Atenção!',
				msg : "Selecione uma empresa",
				icon : Ext.Msg.ERROR,
				buttons : Ext.Msg.OK
			});
		}
	},

	restartSystem : function(btn, e, op) {
		window.location.reload();
	}

});