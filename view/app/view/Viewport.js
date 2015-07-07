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
               'crm.view.usuario.UsuarioGrid', //ok
               'crm.view.usuario.UsuarioForm', //ok
               'crm.view.empresa.EmpresaGrid',
               'crm.view.empresa.EmpresaForm',
               'crm.view.imposto.ImpostoGrid', //ok
               'crm.view.imposto.ImpostoForm', //ok
               'crm.view.pessoafisica.PessoaFisicaGrid',
               'crm.view.pessoafisica.PessoaFisicaForm',
               'crm.view.localidade.LocalidadeForm',
               'crm.view.localidade.LocalidadeGrid'
               'crm.view.lead.LeadForm',
               'crm.view.lead.LeadGrid',
               'crm.view.banco.BancoForm',
               'crm.view.banco.BancoGrid',
               'crm.view.contabanco.ContaBancoForm',
               'crm.view.contabanco.ContaBancoGrid',
     ],
    
    
    
    initComponent: function() {
        var me = this;
        
        Ext.apply(me, {
            items: [
                {
                    xtype: 'localidadegrid'
                }
            ]
        });
                
        me.callParent(arguments);
    }
});