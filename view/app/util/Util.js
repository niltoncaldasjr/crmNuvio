Ext.define('crm.util.Util', {
	statics : { // #1
	decodeJSON : function (text) { // #2
		var result = Ext.JSON.decode(text, true);
		if (!result){
			result = {};
			result.success = false;
			result.msg = text;
		}
		return result;
	},
	showErrorMsg: function (text) { // #3
		Ext.Msg.show({
			title:'Error!',
			msg: text,
			icon: Ext.Msg.ERROR,
			buttons: Ext.Msg.OK
		});
	}
	}
});