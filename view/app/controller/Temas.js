Ext.define('crm.controller.Temas', {
	extend: 'Ext.app.Controller',
	views: [
				'Temas' // #1
			],
	refs: [
				{
					ref: 'temas', // #2
					selector: 'temas'
				}
	],
	
	init: function(application) {
		this.control({
			"temas menuitem": { // #3
				click: this.onMenuitemClick
			}
		});
	},
	
	
	onMenuitemClick: function(item, e, options) {
		Ext.Ajax.request({
		    url: 'rest/guardarcookie.php',
		    params: {
		        tema: item.text
		    },
		    success: function(response){
		        var text = response.responseText;
		        // process server response here
		        window.location.reload();
		    }
		});	


	}
});
