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
    
    requires: [
       'crm.view.Login',
    ],
    
    views: [
    	'Login'
    	
    ],

    //extend: 'crm.Application',
    controllers: [
                  'Login',
                  'Menu',
                  'Pais',
                  'Perfil',
                  'Rotina',
                  'PessoaFisica',
                  'Empresa',
                  'Usuario',
                  'Imposto',
                  'Localidade',
                  'Lead',
                  'Banco',
                  'ContaBanco',
                  'ContatoLead',
                  'Temas'
    ],
    
    
    init: function(){
    	BoasVindas = Ext.getBody().mask('Carregando o Sistema aguarde...', 'splashscreen');
    
    	BoasVindas.addCls('splashscreen');
    	
    	Ext.DomHelper.insertFirst(Ext.query('.x-mask-msg')[0],{
    		cls: 'x-splash-icon'
    	});
    },
    
    launch: function(){
    	var task = new Ext.util.DelayedTask(function(){
    		BoasVindas.fadeOut({
    			duration: 1000,
    			remove: true
    		});
    	BoasVindas.next().fadeOut({
    		duration: 1500,
    		remove: true,
    		listeners: {
    			afteranimate: function(el, starttime, eOpts){
//    				BoasVindas.unmask();
//    				Ext.widget('login');
//    				Ext.create('crm.view.MyViewport');
    				
    				/*-- Função Ajax/JQuery - Verifica se o usuário está em sessão --*/
    				$(function(){
    					$.ajax({
    						url: 'rest/verifySession.php',
    						success: function( data ){
    							if(data > 0)
    							{
    								Ext.create('crm.view.MyViewport');
    							}else{
    								Ext.widget('login');
    							}
    						}
    					});
    				});
    			}
    		}
    	});
    	//console.log('launch');
    	});
		task.delay(2500);
    },
    
    
    
   // autoCreateViewport: true
});
