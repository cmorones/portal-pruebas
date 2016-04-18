
		var essb_postcount_data = {
		'ajax_url': 'http://musica.unam.mx/wp-admin/admin-ajax.php',
		'post_id': '1740'
	};
	jQuery(document).bind('essb_selfpostcount_action', function (e, service, post_id) {		
		post_id = String(post_id);
	jQuery.post(essb_postcount_data.ajax_url, {
	'action': 'essb_self_postcount',
	'post_id': post_id,
	'service': service,
	'nonce': 'bb5bb0f909'
	}, function (data) { if (data) {
		//alert(data);
	}},'json');});
	function essb_self_postcount(service, post_id) {

	jQuery(document).trigger('essb_selfpostcount_action',[service, post_id]);
	};
	var wnd;function essb_window_stat(oUrl, oService, oCountID) { var wnd; var w = 800 ; var h = 500;  if (oService == "twitter") { w = 500; h= 300; } var left = (screen.width/2)-(w/2); var top = (screen.height/2)-(h/2); if (oService == "twitter") { wnd = window.open( oUrl, "essb_share_window", "height=300,width=500,resizable=1,scrollbars=yes,top="+top+",left="+left ); }  else { wnd = window.open( oUrl, "essb_share_window", "height=500,width=800,resizable=1,scrollbars=yes,top="+top+",left="+left ); } essb_handle_stats(oService, oCountID); essb_self_postcount(oService, oCountID); var pollTimer = window.setInterval(function() {if (wnd.closed !== false) { window.clearInterval(pollTimer); essb_smart_onclose_events(oService, oCountID);}}, 200);  }; function essb_pinterenst_stat(oCountID) { essb_handle_stats('pinterest', oCountID); var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)};function essb_window(oUrl, oService, oCountID) { var wnd; var w = 800 ; var h = 500;  if (oService == "twitter") { w = 500; h= 300; } var left = (screen.width/2)-(w/2); var top = (screen.height/2)-(h/2);  if (oService == "twitter") { wnd = window.open( oUrl, "essb_share_window", "height=300,width=500,resizable=1,scrollbars=yes,top="+top+",left="+left ); }  else { wnd = window.open( oUrl, "essb_share_window", "height=500,width=800,resizable=1,scrollbars=yes,top="+top+",left="+left ); } essb_self_postcount(oService, oCountID); var pollTimer = window.setInterval(function() {if (wnd.closed !== false) { window.clearInterval(pollTimer); essb_smart_onclose_events(oService, oCountID);}}, 200); };function essb_pinterenst() {var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)};var essb_count_data = {
				'ajax_url': 'http://musica.unam.mx/wp-admin/admin-ajax.php'
		};function essb_smart_onclose_events(oService, oPostID) { if (typeof (essbasc_popup_show) == 'function') {   essbasc_popup_show(); } if (typeof essb_acs_code == 'function') {   essb_acs_code(oService, oPostID); } }