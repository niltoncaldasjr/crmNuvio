Ext.define('crm.view.SelecaoEmpresa.SelecaoEmpresa',{
	extend: 'Ext.window.Window',
	alias: 'widget.selecaoempresa',
	
	
	requires: [ 'crm.view.SelecaoEmpresa.iconEmpresa', 'crm.view.SelecaoEmpresa.infoPanelEmpresa' ],
	
	height: 170,
	width: 500,
	autoShow : true,
	layout:  'border',
	title: 'Selecione a Empresa',
	closeAction: 'hide',
	border: 'false',
	bodyBorder: 'false',
	
	items: [
	   {
		   xtype: 'panel',
		   region: 'center',
		   flex: 1,
		   layout: 'fit',
		   items: [
		      {
		    	  xtype: 'iconempresa',
		    	  autoScroll: true,
		    	  id: 'img-chooser-view',
		    	  
		      },
		   ]
	   },
	   {
		   xtype: 'infopanelempresa',
		   region: 'east',
		   //collapsible: true,
		   //style: 'background-color: #8FB488;',
		   split: true,
		   //width: 100
	   }
	   
	],

	init : function(application) {
		this.control({
			 //this.callParent(arguments);
			 //console.log('Entramos');
			 
			 listeners: {
	             selectionchange: "onIconSelect",
	             //itemdblclick: "fireImageSelected"
	         }
		        
		        /**
		         * Specifies a new event that this component will fire when the user selects an item. The event is fired by the
		         * fireImageSelected function below. Other components can listen to this event and take action when it is fired
		         */
//		        this.addEvents(
//		            /**
//		             * @event selected
//		             * Fired whenever the user selects an image by double clicked it or clicking the window's OK button
//		             * @param {Ext.data.Model} image The image that was selected
//		             */
//		            'selected'
//		        );
		});
	},
	
	onIconSelect: function(dataview, selections) {
        var selected = selections[0];
        
        console.log('entramos aqui');
        
        if (selected) {
            this.down('infopanelempresa').loadRecord(selected);
        }
    },
});