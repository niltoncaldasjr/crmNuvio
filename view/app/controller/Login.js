Ext.define('crm.controller.Login', { 
	extend : 'Ext.app.Controller', 
	requires: [
	           'crm.util.MD5',
	           'crm.util.Util',
	           'crm.util.SessionMonitor'
	],
	
	views: [
		'Login',
		'Header',
		'authentication.CapsLockTooltip',
		
	],
	refs: [
		{
		ref: 'capslockTooltip',
		selector: 'capslocktooltip'
		}
		],
	
	init : function(application) {
		this.control({
			"login form button#submit" : { 
				click : this.onButtonClickSubmit
			// #2
			},
			"login form button#cancel" : { 
				click : this.onButtonClickCancel
			// #4
			},
			"login form textfield": {
				specialkey: this. onTextfieldSpecialKey
			},
			"login form textfield[name=password]": {
				keypress: this.onTextfieldKeyPress
			},
			"appheader button#logout": {
				click: this.onButtonClickLogout
				}
		});
	},
	onButtonClickSubmit : function(button, e, options) {
		var formPanel = button.up('form'),
		login = button.up('login'),
		user = formPanel.down('textfield[name=user]').getValue(),
		pass = formPanel.down('textfield[name=password]').getValue();
		pass = crm.util.MD5.encode(pass);
		
		if (formPanel.getForm().isValid()) {
			Ext.get(login.getEl()).mask("Authenticating... Please wait...",
			'loading');
			Ext.Ajax.request({
				url: 'rest/login.php',
				params: {
					user: user,
					password: pass
			},
			failure: function(conn, response, options, eOpts) {
				Ext.get(login.getEl()).unmask();
				Ext.Msg.show({
					title:'Error!',
					msg: conn.responseText,
					icon: Ext.Msg.ERROR,
					buttons: Ext.Msg.OK
				});
			},
			success: function(conn, response, options, eOpts) {
				Ext.get(login.getEl()).unmask();
				var result = Ext.JSON.decode(conn.responseText, true); 
				if (!result){ 
					result = {};
					result.success = false;
					result.msg = conn.responseText;
				}
				if (result.success) { 
					login.close(); 
					Ext.create('crm.view.imposto.ImpostoForm').show();
					crm.util.SessionMonitor.start();
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
	},
	onButtonClickCancel : function(button, e, options) {
		button.up('form').getForm().reset();
	},
	
	onTextfieldSpecialKey: function(field, e, options) {
		if (e.getKey() == e.ENTER){
		var submitBtn = field.up('form').down('button#submit');
		submitBtn.fireEvent('click', submitBtn, e, options);
		}
	},
	onTextfieldKeyPress: function(field, e, options) {
		var charCode = e.getCharCode(); 
		if((e.shiftKey && charCode >= 97 && charCode <= 122) || 
				(!e.shiftKey && charCode >= 65 && charCode <= 90)){
			if(this.getCapslockTooltip() === undefined){ 
				Ext.widget('capslocktooltip'); 
			}
			this.getCapslockTooltip().show(); 
			} else {
			if(this.getCapslockTooltip() !== undefined){ 
			this.getCapslockTooltip().hide(); 
			}
			}
	},
	onButtonClickLogout: function(button, e, options) {
		Ext.Ajax.request({
			url: 'rest/logout.php',
			success: function(conn, response, options, eOpts){
				var result =
				crm.util.Util.decodeJSON(conn.responseText);
				if (result.success) {
					button.up('mainviewport').destroy();
					window.location.reload();
				}
				else {
					crm.util.Util.showErrorMsg(conn.responseText);
				}
			},
			failure: function(conn, response, options, eOpts) {
			crm.util.Util.showErrorMsg(conn.responseText);
		}
		});
	}
});