/**
*  Projeto crmNUVIO   - JUNHO/2015
*
*  ScrumMaster ..: Nilton Caldas Jr.
*  P.O ..........: Giovanni Russo.
*  Desenvolvedor.: Adelson Guimarães Monteiro
*  Desenvolvedor.: Fabiano Ferreira da Silva Costa
*/

Ext.Loader.setConfig({enabled: true});

Ext.application({
    name: 'crm',

    //extend: 'crm.Application',
    controllers: [
                  'Pais'
    ],

    
    autoCreateViewport: true
});
