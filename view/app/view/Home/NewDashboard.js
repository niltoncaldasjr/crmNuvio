/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.home.NewDashboard', {

    extend: 'Ext.container.Container',
    requires: [
               'crm.view.home.PortalPanel', 
               'crm.view.home.PortalColumn',
               'crm.view.home.PortalDropZone',
               'crm.view.home.Portlet', 
               'crm.view.pais.PaisGrid', 
               'crm.view.lead.LeadGrid',
               'crm.view.banco.BancoGrid'
    ],
    alias: 'widget.newdashboard',
    getTools: function(){
        return [{
            xtype: 'tool',
            type: 'gear',
            handler: function(e, target, header, tool){
                var portlet = header.ownerCt;
                portlet.setLoading('Carregando...');
                console.log(portlet);
                Ext.defer(function() {
                    portlet.setLoading(false);
                }, 2000);
            }
        }];
    },

    initComponent: function(){       

        Ext.apply(this, {
            id: 'app-container',
            layout: {
                type: 'border',
                padding: '0 5 5 5' // pad the layout from the window edges
            },
            items: [{
                xtype: 'container',
                region: 'center',
                layout: 'border',
                items: [{
                    id: 'app-portal',
                    xtype: 'portalpanel',
                    region: 'center',
                    items: [{
                        id: 'col-1',
                        items: [{
                            id: 'portlet-1',
                            title: 'Cadastro de Paises',
                        	iconCls: 'icon-grid',
                            tools: this.getTools(),
                            items:
							 Ext.create('crm.view.pais.PaisGrid',{title: "",iconCls: ""}),
                            listeners: {
                                'close': Ext.bind(this.onPortletClose, this)
                            }
                        },{
                            id: 'portlet-2',
                            title: 		'Cadastro de Lead',
                        	iconCls: 	'icon-grid',
                            tools: this.getTools(),
                            items:
   							 Ext.create('crm.view.lead.LeadGrid',{title: "",iconCls: ""}),
                            listeners: {
                                'close': Ext.bind(this.onPortletClose, this)
                            }
                        }]
                    },{
                        id: 'col-2',
                        items: [{
                            id: 'portlet-3',
                            title: 		'Logs do Sistema',
                        	iconCls: 	'icon-grid',
                            tools: this.getTools(),
                            items:
							 Ext.create('crm.view.logsistema.LogSistemaGrid',{title: "",iconCls: ""}),
                            listeners: {
                                'close': Ext.bind(this.onPortletClose, this)
                            }
                        }]
                    },{
                        id: 'col-3',
                        items: [{
                            id: 'portlet-4',
                            title: 		'Cadastro de Banco',
                        	iconCls: 	'icon-grid',
                            tools: this.getTools(),
                            items:
							 Ext.create('crm.view.banco.BancoGrid',{title: "",iconCls: ""}),
                            listeners: {
                                'close': Ext.bind(this.onPortletClose, this)
                            }
                        }]
                    }]
                }]
            }]
        });
        this.callParent(arguments);
    },

    onPortletClose: function(portlet) {
        this.showMsg('"' + portlet.title + '" was removed');        
    },

    showMsg: function(msg) {
        var el = Ext.get('app-msg'),
            msgId = Ext.id();

        this.msgId = msgId;
        el.update(msg).show();

        Ext.defer(this.clearMsg, 3000, this, [msgId]);
    },

    clearMsg: function(msgId) {
        if (msgId === this.msgId) {
            Ext.get('app-msg').hide();
        }
    }
});
