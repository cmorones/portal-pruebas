<?php

/*
*	Addon Details
*	Version: 0.6
*	Last Updated: 2014-6-18
*/



	$addons = array(
		'eventon-action-user' => array(
			'id'=>'EVOAU',
			'name'=>'Action User',
			'link'=>'http://www.myeventon.com/addons/action-user/',
			'download'=>'http://www.myeventon.com/addons/action-user/',
			'desc'=>'Wanna get event contributors involved in your EventON calendar with better permission control? You can do that plus lot more with Action User addon.',
		),'eventon-daily-view' => array(
			'id'=>'EVODV',
			'name'=>'Daily View Addon',
			'link'=>'http://www.myeventon.com/addons/daily-view/',
			'download'=>'http://www.myeventon.com/addons/daily-view/',
			'desc'=>'Do you have too many events to fit in one month and you want to organize them into days? This addon will allow you to showcase events for one day of the month at a time.',
		),'eventon-full-cal'=>array(
			'id'=>'EVOFC',
			'name'=>'Full Cal',
			'link'=>'http://www.myeventon.com/addons/full-cal/',
			'download'=>'http://www.myeventon.com/addons/full-cal/',
			'desc'=>'The list style calendar works for you but you would really like a full grid calendar? Here is the addon that will convert EventON to a full grid calendar view.'
		)
		,'eventon-events-map'=>array(
			'id'=>'EVEM',
			'name'=>'Events Map',
			'link'=>'http://www.myeventon.com/addons/events-map/',
			'download'=>'http://www.myeventon.com/addons/events-map/',
			'desc'=>'What is an event calendar without a map of all events? EventsMap is just the tool that adds a big google map with all the events for visitors to easily find events by location.'
		),'eventon-event-lists'=>array(
			'id'=>'EVEL',
			'name'=>'Event Lists Ext.',
			'link'=>'http://www.myeventon.com/addons/event-lists-extended/',
			'download'=>'http://www.myeventon.com/addons/event-lists-extended/',
			'desc'=>'Do you need to show events list regardless of what month the events are on? With this adodn you can create various event lists including past events, next 5 events, upcoming events and etc.'
		)
		
		,'eventon-single-event'=>array(
			'id'=>'EVOSE',
			'name'=>'Single Events',
			'link'=>'http://www.myeventon.com/addons/single-events/',
			'download'=>'http://www.myeventon.com/addons/single-events/',
			'desc'=>'Looking to promote single events in EventON via social media? Use this addon to share individual event pages that matches the awesome EventON layout design.'
		),'eventon-daily-repeats'=>array(
			'id'=>'EVODR',
			'name'=>'Daily Repeats',
			'link'=>'http://www.myeventon.com/addons/daily-repeats/',
			'download'=>'http://www.myeventon.com/addons/daily-repeats/',
			'desc'=>'Daily Repeats will allow you to create events that can repeat on a daily basis - a feature that extends the repeating events capabilities of the calendar.'
		),'eventon-csv-importer'=>array(
			'id'=>'EVOCSV',
			'name'=>'CSV Importer',
			'link'=>'http://www.myeventon.com/addons/csv-event-importer/',
			'download'=>'http://www.myeventon.com/addons/csv-event-importer/',
			'desc'=>'Are you looking to import events from another program to EventON? CSV Import addon is the tool for you. It will import any number of events from a properly build CSV file into your EventON Calendar in few steps.'
		),'eventon-rsvp'=>array(
			'id'=>'EVORS',
			'name'=>'RSVP Events',
			'link'=>'http://www.myeventon.com/addons/rsvp-events/',
			'download'=>'http://www.myeventon.com/addons/rsvp-events/',
			'desc'=>'Do you want to allow your attendees RSVP to event so you know who is coming and who is not? and be able to check people in at the event? RSVP event can do that for you seamlessly.'
		),'eventon-tickets'=>array(
			'id'=>'EVOTX',
			'name'=>'Event Tickets',
			'link'=>'http://www.myeventon.com/addons/event-tickets/',
			'download'=>'http://www.myeventon.com/addons/event-tickets/',
			'desc'=>'Are you looking to sell tickets for your events with eventON? Event Tickets powered by Woocommerce is the ultimate solution for your ticket sales need. Stop paying percentage of your ticket sales and try event tickets addon!.'
		),'eventon-qrcode'=>array(
			'id'=>'EVOQR',
			'name'=>'QR Code',
			'link'=>'http://www.myeventon.com/addons/qr-code',
			'download'=>'http://www.myeventon.com/addons/qr-code',
			'desc'=>'Do you want to allow your attendees RSVP to event so you know who is coming and who is not? and be able to check people in at the event? RSVP event can do that for you seamlessly.'
		),'eventon-weekly-view'=>array(
			'id'=>'EVOWV',
			'name'=>'Weekly View',
			'link'=>'http://www.myeventon.com/addons/weekly-view',
			'download'=>'http://www.myeventon.com/addons/weekly-view',
			'desc'=>'Do you have too many events to fit in one month and you want to organize them into days? This addon will allow you to showcase events for one day of the month at a time.'
		)
	);

	
// eventon addons list 
if(isset($_POST['action']) && $_POST['action']=='evo_addons'){
	$eventon_addons_opt = unserialize( base64_decode($_POST['eventon_addons_opt']));
	$evo_licenses = unserialize(base64_decode($_POST['evo_licenses']));
	$activePlugins = (!empty($_POST['active_plugins']))? unserialize(base64_decode($_POST['active_plugins'])): false;
	$admin_url = ($_POST['adminurl']);

	ob_start();
	// installed addons
		/*
		if(!empty($eventon_addons_opt) and count($eventon_addons_opt)>0 ){
			foreach($eventon_addons_opt as $tt=>$yy){
				$evo_installed_addons[]=$tt;
			}
		}else{	$evo_installed_addons=false;	}
		*/

		$count=1;
		// EACH ADDON
		foreach($addons as $slug=>$addons){

			$_has_addon = false;
			// Check if addon is installed in the website
			//$_has_addon = ($evo_installed_addons && in_array($slug, $evo_installed_addons))?true:false;
			if(!empty($activePlugins)){
				foreach($activePlugins as $plugin){
					// check if foodpress is in activated plugins list
					if(strpos( $plugin, $slug.'.php') !== false){
						$_has_addon = true;
					}
				}
			}else{	$_has_addon = false;	}
			
			
			if($_has_addon){
				$_addon_options_array = $eventon_addons_opt[$slug];				
			}
			
			// initial variables
				$guide = ($_has_addon && !empty($_addon_options_array['guide_file']) )? "<span class='eventon_guide_btn eventon_popup_trig' ajax_url='{$_addon_options_array['guide_file']}' poptitle='How to use {$addons['name']}'>Guide</span> | ":null;
				
				$__action_btn = (!$_has_addon)? "<a class='evo_admin_btn btn_secondary' target='_blank' href='". $addons['download']."'>Get it now</a>": "<a class='eventon_popup_trig evo_admin_btn btn_prime' dynamic_c='1' content_id='eventon_pop_content_{$slug}' poptitle='Activate {$addons['name']} License'>Activate Now</a>";

				$__remote_version = (!empty($evo_licenses[$slug]['remote_version']))? '<span title="Remote server version"> /'.$evo_licenses[$slug]['remote_version'].'</span>': null;

				
				
			
			// ACTIVATED
			if(!empty($evo_licenses[$slug]['status']) && $evo_licenses[$slug]['status']=='active' && $_has_addon):
			
			?>
				<div id='evoaddon_<?php echo $slug;?>' class="addon activated <?php echo ($_has_update)? 'hasupdate':null;?>">
					<h2><?php echo $addons['name']?></h2>
					<p class='version'><span><?php echo $eventon_addons_opt[$slug]['version']?></span><?php echo $__remote_version;?></p>
					<p class='status'>License Status: <strong>Activated</strong> | <a href='?page=eventon&tab=evcal_4&action=rl&slug=<?php echo $slug;?>'>Deactivate</a></p>
					<p class="links"><?php echo $guide;?><a href='<?php echo $addons['link'];?>' target='_blank'>Learn More</a></p>
				</div>
			
			<?php	
				// NOT ACTIVATED
				else:
			?>
				<div id='evoaddon_<?php echo $slug;?>' class="addon <?php echo (!$_has_addon)?'donthaveit':null;?>">
					<h2><?php echo $addons['name']?></h2>
					<?php if(!empty($eventon_addons_opt[$slug])):?><p class='version'><span><?php echo $eventon_addons_opt[$slug]['version']?></span></p><?php endif;?>
					<p class='status'>License Status: <strong>Not Activated</strong></p>
					<p class='action'><?php echo $__action_btn;?></p>
					<p class="links"><?php echo $guide;?><a href='<?php echo $addons['link'];?>' target='_blank'>Learn More</a></p>
					<p class='activation_text'></p>
						<div id='eventon_pop_content_<?php echo $slug;?>' class='evo_hide_this'>
							<p>Addon License Key <br/>
							<input class='eventon_license_key_val' type='text' style='width:100%'/>
							<input class='eventon_slug' type='hidden' value='<?php echo $slug;?>' />
							<input class='eventon_id' type='hidden' value='<?php echo $addons['id'];?>' />
							<input class='eventon_license_div' type='hidden' value='evoaddon_<?php echo $slug;?>' /></p>
							<p>Email Address used <span class='evoGuideCall'>?<em>This must be the email address you used to order eventon addon from myeventon.com</em></span><br/><input class='eventon_email_val' type='text' style='width:100%'/></p>
							<p><a class='eventonADD_submit_license evo_admin_btn btn_prime'>Activate Now</a></p>
						</div>
				</div>
			<?php		
				endif;

				$count++;
		} //endforeach

	$content = ob_get_clean();

	$return_content = array(
		'content'=> $content,
		'status'=>true
	);
	
	echo json_encode($return_content);		
	exit;
}


?>