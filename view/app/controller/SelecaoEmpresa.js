Ext.define('crm.controller.SelecaoEmpresa',{
	extend: 'Ext.app.Controller',
	
	stores: ['SelecaoEmpresa'],
	
	models: ['selecaoempresa.SelecaoEmpresa'],
	
	views: ['SelecaoEmpresa.SelecaoEmpresa', 'SelecaoEmpresa.IconEmpresa'],
	
//	ref: [{
//		ref: 'selecaoempresa',
//		selector: 'window'
//	}],
	
	init: function(application){
		this.control({
			"iconempresa" : {
				selectionchange: this.onIconSelect,
				itemdblclick: this.fireImageSelected
			},
			
		});
	},
	
	
	
  onIconSelect: function(dataview, selections) {
      var selected = selections[0];
      
      if (selected) {
    	  Ext.ComponentQuery.query('infopanelempresa')[0].loadRecord(selected);
      }
  },
  
  
  
  /**
   * Fires the 'selected' event, informing other components that an image has been selected
   */
  fireImageSelected: function() {
	  var win = Ext.ComponentQuery.query('selecaoempresa')[0];
	    
	  var selectedImage = win.down('iconempresa').selModel.getSelection()[0];
      
      if (selectedImage) {
    	  
    	  console.log("ID Empresa: "+selectedImage.get('id'));
    	  
          //this.fireEvent('selected', selectedImage);
          //this.hide();
          win.close();
          
          Ext.create('crm.view.MyViewport');
      }
  }
});