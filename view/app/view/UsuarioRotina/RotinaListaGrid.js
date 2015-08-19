Ext.define('crm.view.usuariorotina.RotinaListaGrid',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.rotinalistagrid',
	title: 'Rotinas',
	iconCls: 'icon-grid',
	store: 'Rotina',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Rotina', 	dataIndex: 'nome'},
	    {
	    	text: 'Menu', 	
	    	dataIndex: 'subrotina',
	    	renderer: function(value, metaData, record){
	    		var store = Ext.getStore('Rotina');
				var rotina = store.findRecord('subrotina', value);
				if(rotina.get('subrotina') != 0){
					return rotina != null ? rotina.get('subrotina') : value;
					
				}
				
				
	    	}
	    }
	],
	
	viewConfig: {
        plugins: {
            ptype: 'gridviewdragdrop',
            dragGroup: 'firstGridDDGroup',
            dropGroup: 'secondGridDDGroup',
            pluginId: 'drag'
        },
   	}
});