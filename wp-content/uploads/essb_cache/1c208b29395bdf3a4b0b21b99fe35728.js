
		var essb_postcount_data = {
		'ajax_url': 'http://musica.unam.mx/wp-admin/admin-ajax.php',
		'post_id': '0'
	};
	jQuery(document).bind('essb_selfpostcount_action', function (e, service, post_id) {		
		post_id = String(post_id);
	jQuery.post(essb_postcount_data.ajax_url, {
	'action': 'essb_self_postcount',
	'post_id': post_id,
	'service': service,
	'nonce': '969a83dd6c'
	}, function (data) { if (data) {
		//alert(data);
	}},'json');});
	function essb_self_postcount(service, post_id) {

	jQuery(document).trigger('essb_selfpostcount_action',[service, post_id]);
	};
	