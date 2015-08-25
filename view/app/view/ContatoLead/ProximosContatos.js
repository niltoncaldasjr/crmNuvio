/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.contatolead.ProximosContatos',{
	extend: 	'Ext.grid.Panel',
	alias: 		'widget.proximoscontato',
	title: 		'Proximos Contatos Lead',
	iconCls: 	'icon-grid',
	store: 		'ContatoLead',
	layout: {
        type: 'fit',
        padding: '0 5 5 5' // pad the layout from the window edges
    },
	
	columns: [
	    {text: 'Retorno', 		dataIndex: 'dataretorno', 		renderer : Ext.util.Format.dateRenderer('d/m/Y')},
	    {text: 'Lead', 				dataIndex: 'idlead',			
	    	renderer: function(value, metaData, record){
				var Store = Ext.getStore('Lead');
				var lead = Store.findRecord('id', value);
				return lead != null ? lead.get('contato') : value;
	    	}			
	    }
	]
	
});