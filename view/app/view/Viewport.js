/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.view.Viewport', {
    extend: 'Ext.container.Viewport',
    requires:[
        'Ext.layout.container.Fit'
    ],

   
  layout: {
      type: 'border'
  },
	
  items: [
		{
			region: 'center',
			xtype: 'panel',
			layout: {
		        type: 'vbox',
		        align: 'stretch'
		    },
			items: [{
		        flex: 2,
		        xtype: 'pessoagrid',
		        collapsible: true,
				split: true
		    },
		    {
		        xtype: 'pessoaform',
//		        title: 'Inner Panel Two',
		        collapsible: true,
		        flex: 2
		    }]
		},
		{
			region: 'west',
			xtype: 'panel',
			split: true,
			title: 'Filtro por Perfil',
			width: 200,
			bodyStyle: 'padding:15px',
			html: '<h4>Escolha do Perfil:</h4> <br><br>[ ] - Administrador<br>[ ] - Operador<br>[ ] - Digitador<br>[ ] - Outros',
		},
		{
			region: 'east',
			xtype: 'panel',
			title: 'Histórico do Usuário',
			width: 400,
			bodyStyle: 'padding:15px',
			html: '<h4>Dados Histórico do Usuários:</h4> <br><br>1 - Fotos<br>2 - Dados Pessoais<br>3 - Logs de Acesso<br>4 - Etc.',
			collapsible: true,
			split: true
		},
		{
			// Topo da Tela Viewport
			region: 'north',
			xtype: 'panel',
			layout: {
		        type: 'vbox',
		        align: 'stretch'
		    },
			height: 100,			
			items: [
			        {
			        	height: 70,
			        	html: '<table><tr><td><img src="/git/akto/cau/resources/images/logo.jpg"></td><td><h3>Controle e Autenticação de Usuário</h3></td></tr></table> '
			        },
			        {
			        	xtype:'menuprincipal',
			        	style: 'background-color: #990000;'
			        }
			]	
		},
		{
			region: 'south',
			xtype: 'panel',
			split: true,
			bodyStyle: 'padding:5px',
			html: 'Rodapé do Sistema',
		}
	]    
    
});
