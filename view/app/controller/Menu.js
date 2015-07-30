Ext.define('crm.controller.Menu',{
	extend: 'Ext.app.Controller',

	requires: [
		//'crm.view.security.Users'
	],

	models: [
		'menu.Root',
		'menu.Item'
	],

	stores: [
		'Menu'
	],

	views: [
		'menu.Accordion',
		'menu.Item',
	],

	refs: [{
		ref: 'mainPanel',
		selector: 'mainpanel'
	}],

	init: function(application){
		this.control({
			"mainmenu": {
				render: this.onPanelRender
			},
			"mainmenuitem": {
				select: this.onTreepanelSelect,
				itemclick: this.onTreepanelItemClick
			}
		});
	},


	onPanelRender: function(abstractcomponent, options){
		this.getMenuStore().load(function(records, op, success){
			var menuPanel = Ext.ComponentQuery.query('mainmenu')[0];

			Ext.each(records, function(root){

				var menu = Ext.create('crm.view.menu.Item',{
					title: root.get('nome'),
					iconCls: root.get('icon')
				});

				Ext.each(root.items(), function(itens){

					Ext.each(itens.data.items, function(item){

						menu.getRootNode().appendChild({
							text: item.get('nome'),
							leaf: true,
							iconCls: item.get('icon'),
							id: item.get('id'),
							className: item.get('class')
						});
					});
				});

				menuPanel.add(menu);
			});
		});
	},

	onTreepanelSelect: function(selModel, record, index, options){

		console.log('Entramos aqui');
		
		var mainPanel = this.getMainPanel();

		var newTab = mainPanel.items.findBy(
			function(tab){
				return tab.title === record.get('text');
			});
		if(!newTab){
			newTab = mainPanel.add({
				xtype: record.raw.className, 
				closable: true,
				iconCls: record.get('iconCls'),
				title: record.get('text')
			});
		}
		mainPanel.setActiveTab(newTab);
	},

	onTreepanelItemClick: function(view, record, item, index, event, options){
		this.onTreepanelSelect(view, record, index, options);
	},

});
