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
               'crm.view.perfil.PerfilGrid', //ok
               'crm.view.perfil.PerfilForm',  //ok
               'crm.view.rotina.RotinaGrid',
               'crm.view.rotina.RotinaForm',
               'crm.view.usuario.UsuarioGrid', // falta o combobox pessoafisica
               'crm.view.usuario.UsuarioForm', // falta o combobox pessoafisica
               'crm.view.empresa.EmpresaGrid',
               'crm.view.empresa.EmpresaForm',
               'crm.view.imposto.ImpostoGrid', //ok
               'crm.view.imposto.ImpostoForm', //ok
               'crm.view.pessoafisica.PessoaFisicaGrid',
               'crm.view.pessoafisica.PessoaFisicaForm'
     ],
    
    
    
    initComponent: function() {
        var me = this;
        
        Ext.apply(me, {
            items: [
                {
                    xtype: 'impostogrid'
                }
            ]
        });
                
        me.callParent(arguments);
    }
});