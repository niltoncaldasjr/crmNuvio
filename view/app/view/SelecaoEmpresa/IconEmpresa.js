Ext.define('crm.view.SelecaoEmpresa.IconEmpresa', {
    extend: 'Ext.view.View',
    alias: 'widget.iconempresa',
    
//    uses: 'Ext.data.Store',
    
    store: 'SelecaoEmpresa',
    
	singleSelect: true,
    overItemCls: 'x-view-over',
    itemSelector: 'div.thumb-wrap',
    tpl: [
        // '<div class="details">',
            '<tpl for=".">',
                '<div class="thumb-wrap">',
                    '<div class="thumb">',
                    (!Ext.isIE6? '<img src="../libs/images/{imagemLogotipo}" />' : 
                    '<div style="width:74px;height:74px;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'../libs/images/{imagemLogotipo}\')"></div>'),
                    '</div>',
                    '<span>{nomeFantasia}</span>',
                '</div>',
            '</tpl>'
        // '</div>'
    ],
    
//    initComponent: function() {
//        this.store = Ext.create('Ext.data.Store', {
//            autoLoad: true,
//            fields: ['id', 'nomeFantasia', 'imagemLogotipo', 'endereco', 'razaoSocial'],
//            proxy: {
//                type: 'ajax',
//                url : 'rest/empresausuario.php',
//                reader: {
//                    type: 'json',
//                    root: 'items'
//                }
//            }
//        });
        
//        this.callParent(arguments);
//        this.store.sort();
//    }
});