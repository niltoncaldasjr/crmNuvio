Ext.define('crm.view.SelecaoEmpresa.InfoPanelEmpresa', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.infopanelempresa',
    id: 'img-detail-panel',

    width: 150,
    minWidth: 150,

    tpl: [
        '<div class="details">',
            '<tpl for=".">',
                    (!Ext.isIE6? '<img src="..libs/images/{imagemLogotipo}" />' : 
                    '<div style="width:74px;height:74px;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'.libs/images/{imagemLogotipo}\')"></div>'),
                '<div class="details-info">',
                    '<b>Info Empresa:</b>',
                    '<span>{nomeFantasia}</span>',
                    '<b>Endereço:</b>',
                    '<span>{endereco}</span>',
                    '<b>Razão Social:</b>',
                    '<span>{razaoSocial}</span>',
                '</div>',
            '</tpl>',
        '</div>'
    ],
    
    afterRender: function(){
        this.callParent();
        if (!Ext.isWebKit) {
            this.el.on('click', function(){
                alert('The Sencha Touch examples are intended to work on WebKit browsers. They may not display correctly in other browsers.');
            }, this, {delegate: 'a'});
        }    
    },

    /**
     * Loads a given image record into the panel. Animates the newly-updated panel in from the left over 250ms.
     */
    loadRecord: function(image) {
        this.body.hide();
        this.tpl.overwrite(this.body, image.data);
        this.body.slideIn('l', {
            duration: 250
        });
    },
    
    clear: function(){
        this.body.update('');
    }
});