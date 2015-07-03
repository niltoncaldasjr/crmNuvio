/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.define('crm.view.Viewport', {
    extend: 'Ext.Viewport',    
    layout: 'fit',
    
   
    requires: [
        'crm.view.rotina.RotinaGrid',
        'crm.view.rotina.RotinaForm'
    ],
    
    initComponent: function() {
        var me = this;
        
        Ext.apply(me, {
            items: [
                {
                    xtype: 'rotinagrid'
                }
            ]
        });
                
        me.callParent(arguments);
    }
});