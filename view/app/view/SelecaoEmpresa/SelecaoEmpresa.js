Ext.define('crm.view.SelecaoEmpresa.SelecaoEmpresa', {
    extend: 'Ext.window.Window',
    alias: 'widget.selecaoempresa',
    
    requires: [
    	'crm.view.SelecaoEmpresa.IconEmpresa',
    	'crm.view.SelecaoEmpresa.InfoPanelEmpresa'
    ],
    
    height: 250,
    width : 800,
    title : 'Selecione a empresa',
    iconCls: 'icon-empresa-add',
    closeAction: 'hide',
    layout: 'border',
    autoShow: true,
    // modal: true,
    border: false,
    bodyBorder: false,
    closable: false,
    resizable: false,
    draggable: false,
    
//    initComponent: function() {
//        this.items = [
    	items: [
            {
                xtype: 'panel',
                region: 'center',
                layout: 'fit',
                items: {
                    xtype: 'iconempresa',
                    autoScroll: true,
                    id: 'img-chooser-view',
//                    listeners: {
//                        scope: this,
//                        selectionchange: this.onIconSelect,
//                        itemdblclick: this.fireImageSelected
//                    }
                },
            },
            {
                xtype: 'infopanelempresa',
                region: 'east',
                split: true
            }
        ],
        
        dockedItems: [{
        	xtype : 'toolbar',
			dock : 'bottom',
			items : [ 
			/*-- Espaçamento --*/
			{
				xtype: 'tbfill' //ou '->'
			},
			/*-- Separador da barra de ferramentas --*/
//			{
//				xtype: 'tbseparator' //ou '-'
//			},
        	{
            	 text: 'Selecionar',
            	 iconCls: 'icon-empresa_entrar-add',
            	 itemId: 'okselecaoempresa',
                 scope: this
                 
             },
             {
            	 text: 'Cancelar',
            	 iconCls: 'cancel',
            	 itemId: 'cancelselecaoempresa',
                 scope: this
                 
             }]
        }]
        
//        this.buttons = [
//            {
//                text: 'OK',
//                scope: this,
//                handler: this.fireImageSelected
//            },
//            {
//                text: 'Cancel',
//                scope: this,
//                handler: function() {
//                    this.hide();
//                }
//            }
//        ];
        
//        this.callParent(arguments);
//        
//        /**
//         * Specifies a new event that this component will fire when the user selects an item. The event is fired by the
//         * fireImageSelected function below. Other components can listen to this event and take action when it is fired
//         */
//        this.addEvents(
//            /**
//             * @event selected
//             * Fired whenever the user selects an image by double clicked it or clicking the window's OK button
//             * @param {Ext.data.Model} image The image that was selected
//             */
//            'selected'
//        );
//    },
//    
//    
//    
//    /**
//     * Called whenever the user clicks on an item in the DataView. This tells the info panel in the east region to
//     * display the details of the image that was clicked on
//     */
//    onIconSelect: function(dataview, selections) {
//        var selected = selections[0];
//        
//        if (selected) {
//            this.down('infopanelempresa').loadRecord(selected);
//        }
//    },
//    
//    
//    
//    /**
//     * Fires the 'selected' event, informing other components that an image has been selected
//     */
//    fireImageSelected: function() {
//        var selectedImage = this.down('iconempresa').selModel.getSelection()[0];
//        
//        console.log("ID Empresa: "+selectedImage.get('id'));
////        if (selectedImage) {
////            this.fireEvent('selected', selectedImage);
////            //this.hide();
////            this.close();
////        }
//    }
});