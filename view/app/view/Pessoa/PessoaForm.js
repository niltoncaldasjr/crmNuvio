/**
 * Controle e Autenticação de usuários - CAU 
 * Outubro/2014
 * Desenvolvedores : Allan Magnum e Nilton Caldas Jr.
 */

Ext.define('cau.view.pessoa.PessoaForm',{
	
	extend: 'Ext.tab.Panel',	
	alias: 'widget.pessoaform',

	height: 200,
	width: 350,
	layout: 'fit',
	iconCls: 'icon-user',
	title: 'Editar/Criar Pessoa',
	autoShow: true,

	items: [
//	        1. Aba dados GERAIS -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		{
			title: 'Dados Gerais',
			xtype: 'form',
			bodyPadding: 10,
			defaults: {
				anchor: '100%'
			},
			frame:true,
			autoScroll:true,
			itemId: 'gerais',
			items: [
					{
						xtype: 'hiddenfield',
				        name: 'id'
					},
					{
						xtype: 'textfield',
				        name: 'nome',
				        fieldLabel: 'Nome',
				        allowBlank: false
					},
					{
						// column layout with 2 columns
						layout:'column',

						// defaults for columns
						defaults:{
							 columnWidth:0.5,
							 layout:'form',
							 border:false,
							 xtype:'panel',
							 bodyStyle:'padding:0 18px 0 0',
							 frame:true
						},
						items:[{
							// left column
							// defaults for fields
							 defaults:{anchor:'100%'},
							 items:[{
								 xtype:'cpffield',
								 fieldLabel:'CPF',
								 name: 'cpf'
							},{
								 xtype:'datefield',
//								 xtype: 'textfield',
								 fieldLabel:'Data Nascimento',
								 format: 'd/m/Y',
								 name: 'dataNascimento'	
							}]
						},{
							// right column
							// defaults for fields
							 defaults:{anchor:'100%'},
							 items:[{
								 xtype:'combo',
								 fieldLabel:'Estado Civil',
								 name: 'enum_estadoCivil',	
								 store:["SOLTEIRO","CASADO","DIVORCIADO","VIUVO"]
							},{
								 xtype:'combo',
								 fieldLabel:'Sexo',
								 name: 'enum_sexo',	
								 store:["MASCULINO","FEMININO"]
							}]
						}]
					},
					{
						xtype: 'textfield',
				        name: 'nomePai',
				        fieldLabel: 'Nome do Pai'
					},
					{
						xtype: 'textfield',
				        name: 'nomeMae',
				        fieldLabel: 'Nome da Mâe'
					},
					{
						xtype: 'combo',
				        name: 'enum_cor',
				        fieldLabel: 'Cor',
				        store:["BRANCA","PRETA","PARDA","AMARELA"]
					},
					{
						xtype: 'textfield',
				        name: 'naturalidade',
				        fieldLabel: 'Naturalidade'
					},
					{
						xtype: 'textfield',
				        name: 'nacionalidade',
				        fieldLabel: 'Nacionalidade'
					},
					
					]
		}, 
//        2. Aba Lista de Endereços -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		{
			title: 'Endereço',
			xtype: 'panel',
			layout: {
		        type: 'vbox',
		        align: 'stretch'
		    },
	        items:[
	               {flex: 1,
	            	xtype: 'enderecopfgrid'}
//	               {flex: 2,
//	            	xtype: 'enderecopfform'}
	        ],
	        itemId: 'enderecopf'
	    }, 
//        3. Aba Lista de Contatos -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	    {
	        title: 'Contato',
			xtype: 'panel',
			layout: {
		        type: 'vbox',
		        align: 'stretch'
		    },
	        items:[
	               {flex: 1,
	            	xtype: 'contatopfgrid'}
//	               {flex: 2,
//	            	xtype: 'contatopfform'}
	        ],
	        itemId: 'contatopf'
	    }, 
//        4. Aba Lista de Documentos -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	    {
	        title: 'Documentos',
			xtype: 'panel',
			layout: {
		        type: 'vbox',
		        align: 'stretch'
		    },
	        items:[
	               {flex: 1,
	            	xtype: 'documentopfgrid'}
//	               {flex: 2,
//	            	xtype: 'documentopfform'}
	        ],
	        itemId: 'documentopf'
	    }
	],
	dockedItems: [
		{
			xtype: 'toolbar',
			dock: 'bottom',
			layout: {
				type: 'hbox',
				pack: 'end'
			},
			items: [
				{
					xtype: 'button',
					text: 'Cancelar',
					itemId: 'cancel',
					iconCls: 'icon-reset'
				},
				{
					xtype: 'button',
					text: 'Atualizar',
					itemId: 'save',
					iconCls: 'icon-save'
				},
				{
					xtype: 'button',
					text: 'Salvar',
					itemId: 'save2',
					iconCls: 'icon-save'
				}
			]
		}
	]
});