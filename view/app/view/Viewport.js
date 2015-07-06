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
        'crm.view.pais.PaisGrid',
        'crm.view.pais.PaisForm',
        'crm.view.perfil.PerfilGrid',
        'crm.view.perfil.PerfilForm',
        'crm.view.rotina.RotinaGrid',
        'crm.view.rotina.RotinaForm',
        'crm.view.pessoafisica.PessoaFisicaGrid',
        'crm.view.pessoafisica.PessoaFisicaForm'
    ],
    
    initComponent: function() {
        var me = this;
        
        Ext.apply(me, {
            items: [
                {
                    xtype: 'pessoafisicagrid'
                }
            ]
        });
                
        me.callParent(arguments);
    }
});