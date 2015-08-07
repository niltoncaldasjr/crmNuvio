Ext.define('crm.view.authentication.CapsLockTooltip', {
	extend: 'Ext.tip.QuickTip',
	alias: 'widget.capslocktooltip',
	target: 'password',
	anchor: 'top',
	anchorOffset: 60,
	width: 300,
	dismissDelay: 0,
	autoHide: false,
	title: '<div class="capslock">Caps Lock ativado</div>',
	html: '<div>Se Caps lock estiver ativado, isso pode fazer com que você digite a senha incorretamente.</div><br/>' +
	'<div>Você deve pressionar a tecla Caps lock para desativá-la antes de digitar a senha.</div>'
});