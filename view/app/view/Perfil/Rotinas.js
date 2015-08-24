Ext.define('crm.view.perfil.Rotinas',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.rotinas',
	title: 'Rotinas',
	iconCls: 'icon-grid',
	store: 'Rotina',
	multiSelect: true,
	
	columns: [
	    {text: 'ID', 	dataIndex: 'id'},
	    {text: 'Rotina', 	dataIndex: 'nome', width: 150},
//	    {
//	    	text: 'Menu', 	
//	    	dataIndex: 'subrotina',
//	    	renderer: function(value, metaData, record){
//	    		var store = Ext.getStore('Rotina');
//				var rotina = store.findRecord('subrotina', value);
//				if(rotina.get('subrotina') != 0){
//					return rotina != null ? rotina.get('nome') : value;					
//				}
//	    	}
//	    }
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