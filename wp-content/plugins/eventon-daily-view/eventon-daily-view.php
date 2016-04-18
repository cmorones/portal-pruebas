<?php
/*
 Plugin Name: EventON - Daily View (no actualizar)
 Plugin URI: http://www.myeventon.com/addons/daily-view/
 Description: Adds the capabilities to create a calendar with horizontally scrollable list of days of the month right below month title and sort bar. Read the guide for more information on how to use this addon.
 Author: Ashan Jay
 Version: 0.27
 Author URI: http://www.ashanjay.com/
 Requires at least: 3.8
 Tested up to: 4.1

 */


 
class EventON_daily_view{
	
	public $version='0.27';
	public $eventon_version = '2.2.22';
	public $name = 'DailyView';
		
	public 	$day_names = array();
	public 	$full_day_names = array();
	private $focus_day_data= array();
	public $is_running_dv =false;
	
	
	public $addon_data = array();
	public $slug, $plugin_slug , $plugin_url , $plugin_path ;
	public $template_url ;	
	private $urls;
	
	public $shortcode_args;
	
	/*
	 * Construct
	 */
	public function __construct(){
		
		$this->super_init();

		include_once( 'admin/class-admin_check.php' );
		$this->check = new addon_check($this->addon_data);
		$check = $this->check->initial_check();
		
		if($check){
			$this->addon = new evo_addon($this->addon_data);
		
			add_action( 'init', array( $this, 'init' ), 0 );

			add_action('eventon_calendar_header_content',array($this, 'calendar_header_hook'), 10, 1);
			add_action('evo_cal_footer',array($this, 'calendar_footer'), 10);	

			// scripts and styles 
			add_action( 'init', array( $this, 'register_styles_scripts' ) ,15);					
			
			//add_action('eventon_sorting_filters',array( $this, 'content_below_sortbar_this' ), 10,1);
			$this->includes();
			
		}
	}
	
	
	// SUPER init
		function super_init(){
			// PLUGIN SLUGS			
			$this->addon_data['plugin_url'] = path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)));
			$this->addon_data['plugin_slug'] = plugin_basename(__FILE__);
			list ($t1, $t2) = explode('/', $this->addon_data['plugin_slug'] );
	        $this->addon_data['slug'] = $t1;
	        $this->addon_data['plugin_path'] = dirname( __FILE__ );
	        $this->addon_data['evo_version'] = $this->eventon_version;
	        $this->addon_data['version'] = $this->version;
	        $this->addon_data['name'] = $this->name;

	        $this->plugin_url = $this->addon_data['plugin_url'];
	        $this->plugin_slug = $this->addon_data['plugin_slug'];
	        $this->slug = $this->addon_data['slug'];
	        $this->plugin_path = $this->addon_data['plugin_path'];
		}

	// INITIATE please
		function init(){
				
			// Activation
			$this->activate();

			// Deactivation
			register_deactivation_hook( __FILE__, array($this,'deactivate'));
			
			
			// RUN addon updater only in dedicated pages
			if ( is_admin() ){
				$this->addon->updater();			
			}

			$this->shortcodes = new evo_dv_shortcode();
		}
		
	
	/** Include required core files.	 */
		function includes(){
			include_once( 'admin/eventonDV_shortcode.php' );
			
			if ( is_admin() )
				include_once( 'admin/admin-init.php' );

			if ( defined('DOING_AJAX') ){
				include_once( 'admin/eventonDV_ajax.php' );
			}
		}
		
	
	
	/**	create the content for the daily view section on the calendar */
		function content_below_sortbar_this($content){
			
			// check if daily view is running on this calendar
			if(!$this->is_running_dv)
				return;
				
			$day_data = $this->focus_day_data;
			$evcal_val1= get_option('evcal_options_evcal_1');

			$this->set_three_letter_day_names();
			$this->set_full_day_names();

			//print_r($day_data);

			// DAILY VIEW section
			$dv_strip_margin = (( ($day_data['day'])*(-40) )+130 ).'px';
			$hide_arrows = ($evcal_val1['evcal_arrow_hide']=='yes')? true:false;
			

			// current date section
			$day_of_week = date('N', $day_data['focus_start_date_range']);
			$dayname = $this->get_full_day_names($day_of_week);


			/*if(!empty($this->shortcode_args['hide_date_box']) && $this->shortcode_args['hide_date_box']!='yes'){
				$content.="<div class='evodv_current_day'>
					<p class='evodv_dayname'>{$dayname}</p>
					<p class='evodv_daynum'><span class='prev'><i class='fa fa-angle-left'></i></span><b>{$day_data['day']}</b><span class='next'><i class='fa fa-angle-right'></i></span></p>
					<p class='evodv_events' style='display:none'><span>2</span>". eventon_get_custom_language('', 'evcal_lang_events','Events' )."</p>
				</div>";
			}*/

			$content.="
			<div class='eventon_daily_list ".( (!$hide_arrows)? 'dvlist_hasarrows': 'dvlist_noarrows' )."' cal_id='{$day_data['cal_id']}'>
				".( (!$hide_arrows)? "<a class='evo_daily_prev evcal_arrows'><i class='fa fa-angle-left'></i></a><a class='evo_daily_next evcal_arrows'><i class='fa fa-angle-right'></i></a>":null )."<div class='eventon_dv_outter'>
					<div class='eventon_daily_in' style='margin-left:{$dv_strip_margin}'>";				
						
				$content .= $this->get_daily_view_list($day_data['day'],$day_data['month'], $day_data['year']);
						
					$content .="</div>
				</div>
			</div>";
			
			echo $content;
			
			// Stop this from being getting attached to other calendars.
			remove_action('eventon_after_loadbar',array( $this, 'content_below_sortbar_this' ));
		}
	
		
	
	/**
	 *	MAIN Function to generate the calendar outter shell
	 *	for daily view calendar
	 */
	public function generate_calendar($args){
		global $eventon, $wpdb;		
		
		// extract shortcode arguments
		// connect to support arguments
		$supported_defaults = $eventon->evo_generator->get_supported_shortcode_atts();	
		$args = shortcode_atts( $supported_defaults, $args ) ;
	
		extract($args);

		$this->only_dv_actions($args);

		//print_r($args);

		//  *** SET day month and year values for DV
		if(!empty($fixed_day) && $fixed_day!=0 && $fixed_month!=0 && $fixed_year!=0){
			$__date = $fixed_day;
			$__month = $fixed_month;
			$__year = $fixed_year;
		}else{

			// month and year
			if($month_incre !=0){
				$this_month_num = date('n');
				$this_year_num = date('Y');
				
				$mi_int = (int)$month_incre;
				$new_month_num = $this_month_num +$mi_int;
				
				//month
				$__month = ($new_month_num>12)? 
					$new_month_num-12:
					( ($new_month_num<1)?$new_month_num+12:$new_month_num );
				
				// year		
				$__year = ($new_month_num>12)? 
					$this_year_num+1:
					( ($new_month_num<1)?$this_year_num-1:$this_year_num );

			}else{
				$__month = date_i18n('n');
				$__year = date_i18n('Y');
			}

			$_days_in_month = cal_days_in_month(CAL_GREGORIAN,$__month, $__year);

			// date
			$today_day = date_i18n('j');

			if(!empty($day_incre) && $day_incre!=0){
				$di_int = (int)$day_incre;
				$new_day = $today_day+$di_int;

				// check if day increment cause to move to next month forward
				if($new_day>$_days_in_month){
					$__date = $new_day -$_days_in_month;
					$__month = $__month+1;
					$__year = ($__month>12)? 
						$__year+1:( ($__month<1)?$__year-1:$__year );

				// if day incre move months back
				}elseif($new_day<1){

					$__month = $__month-1;
					$__month = ($__month<1)? 12: $__month;
					$__year = ($__month<1)? $__year-1: $__year;

					$_days_in_prev_month = cal_days_in_month(CAL_GREGORIAN,$__month, $__year);

					$__date = $new_day+$_days_in_prev_month;
				}else{
					$__date= $new_day;
				}
			}else{
				$__date = $today_day;
			}
		}

		// DAY RANGES
		$focus_start_date_range = mktime( 0,0,0,$__month,$__date,$__year );
		$focus_end_date_range = mktime(23,59,59,$__month,$__date,$__year);
		$mo1st=( !empty($args['mo1st']) )? $args['mo1st']: '';
		
		
		// Set focus day data within the class
		$this->focus_day_data = array(
			'day'=>$__date,
			'month'=>$__month,
			'year'=>$__year,
			'mo1st'=>$mo1st,
			'focus_start_date_range'=>$focus_start_date_range,
			'focus_end_date_range'=>$focus_end_date_range,
			'cal_id'=>((!empty($args['cal_id']))? $args['cal_id']:'1')
		);
		$this->is_running_dv=true;
		
		//print_r($this->focus_day_data);
		
		// Add extra arguments to shortcode arguments
		$new_arguments = array(
			'focus_start_date_range'=>$focus_start_date_range,
			'focus_end_date_range'=>$focus_end_date_range,
			'fixed_month'=>$__month,
			'fixed_year'=>$__year,
		);
		
		$args = (!empty($args) && is_array($args))? array_merge($args, $new_arguments): $new_arguments;

		// today title
		if(!empty($args['today']) && $args['today']=='yes' && !empty($args['header_title'])){
			$args['date_header'] = false;
			$args['hide_so'] = 'yes';
		}
		
		// PROCESS variables
		$args__ = $eventon->evo_generator->process_arguments($args);
		$this->shortcode_args=$args__;
		
		// ==================
		$content =$eventon->evo_generator->eventon_generate_calendar($args__);
		
		//echo ($focus_start_date_range -$focus_end_date_range).' '.$focused_month_num;

		$this->remove_dv_only_actions();
		return  $content;	
		
	}

	function calendar_footer(){
		if($this->is_running_dv){
			$this->print_scripts();
		}

		$this->is_running_dv=false;
	}

	//	Function to OUTPUT the daily view days
		function get_daily_view_list($day, $month, $year, $filters='', $shortcode=''){
			global $eventon;
			
			$lang = (!empty($shortcode['lang']))? $shortcode['lang']: null;

			$this->set_three_letter_day_names($lang);
			$this->set_full_day_names($lang);

			$number_days_in_month = $this->days_in_month( $month, $year);
			
			
			$focus_month_beg_range = mktime( 0,0,0,$month,1,$year );
			$focus_month_end_range = mktime( 23,59,59,$month,$number_days_in_month,$year );
			
			// GET GENERAL shortcode arguments if set class-wide
			$shortcode_args = (!empty($shortcode))? $shortcode: $this->shortcode_args;
			//print_r($shortcode_args);

			$wp_arguments = array (
				'post_type' 		=> 'ajde_events',
				'posts_per_page'	=>-1 ,
				'order'				=>'ASC',
				'post_status'=>'publish',
				);

			//search query addition
			if(!empty($shortcode_args['s'])){
				$wp_arguments = array_merge($wp_arguments, array('s'=>$shortcode_args['s']));
			}
			
			// check for available filters and append them to argument
			if(!empty($shortcode_args['filters']) && count($shortcode_args['filters'])>0){
				$wp_arguments = $eventon->evo_generator->apply_evo_filters_to_wp_argument($wp_arguments, $shortcode_args);
			}
			// check for filters via AJAX call to change months
			if(!empty($filters) && count($filters)>0){
				$filters = array('filters'=>$filters);
				$wp_arguments = $eventon->evo_generator->apply_evo_filters_to_wp_argument($wp_arguments, $filters);
			}
			
				
			$event_list_array = $eventon->evo_generator->wp_query_event_cycle($wp_arguments, $focus_month_beg_range, $focus_month_end_range);
			
			
			// build a month array with days that have events
			$date_with_events= $dates_event_counts = array();
			if(is_array($event_list_array) && count($event_list_array)>0){
				
				foreach($event_list_array as $event){	

					$__dur_type = $__duration ='';
					// check for all year event
					$_is_all_year = (!empty($event['event_pmv']['evo_year_long']) && $event['event_pmv']['evo_year_long'][0]=='yes')? true:false;	

					if($_is_all_year){
						$__duration= $number_days_in_month;
						$start_date = 1;
					}else{		
					
						$start_date = (int)(date('j',$event['event_start_unix']));
						$start_month = (int)(date('n',$event['event_start_unix']));
						
						$end_date = (int)(date('j',$event['event_end_unix']));
						$end_month = (int)(date('n',$event['event_end_unix']));	

						$__duration='0';
						// same month
						if($start_month == $end_month){
							// same date
							if($start_date == $end_date){
								$__no_events = (!empty($dates_event_counts[$start_date]))?
										$dates_event_counts[$start_date]:0;
									
								$dates_event_counts[$start_date] = $__no_events+1;

								$date_with_events[$start_date] = $start_date;
							}else if($start_date<$end_date){
							// different date
								$__duration = $end_date - $start_date+1;						
							}
						}else{
							// different month
							// start on this month
							if($start_month == $month){
								$__duration = $number_days_in_month - $start_date +1;			
								$__dur_type = ($__duration==0)? 'eom':'';
							}else{
								if( $end_month != $month){
									// end on next month
									$start_date=1;
									$__duration = $number_days_in_month;
								}else{
									// start on a past month
									$start_date=1;
									$__duration = ($end_date==1)? 1: $end_date-1;
								}
							}
						}
					}

					// run multi-day
					if(!empty($__duration)  || $__dur_type=='eom'){
						$__duration = ($__duration==0 && $__dur_type=='eom')? 1: $__duration;
						for($x=0; $x<$__duration; $x++){
							if( $number_days_in_month >= ($start_date+$x) )

								$__this_date = (int)$start_date + $x;
								//echo $__this_date.'*'.$start_date.'-'.$__duration.'&'.$x.' ';
								
								$__no_events = (!empty($dates_event_counts[$__this_date]))?
									(int)$dates_event_counts[$__this_date]:0;

								$dates_event_counts[$__this_date] = $__no_events+1;
								

								$date_with_events[$start_date+$x] = $start_date+$x;
						}
					}
				}
			}	


			
			//ob_start();
			$__focus_day = ($day >$number_days_in_month)? $number_days_in_month: $day;

			$output='';
			for($x=0; $x<$number_days_in_month; $x++){
				$day_classes = array();

				$day_of_week = date('N',strtotime($year.'-'.$month.'-'.($x+1)));
				
				// class name additions
					if(is_array($date_with_events) && count($date_with_events)>0){
						if(in_array($x+1, $date_with_events))
							$day_classes[] = 'has_events';
					}				
					if($__focus_day==($x+1))
						$day_classes[] = 'on_focus';
					if($x+1 < $__focus_day)
						$day_classes[] ='past_day';
					

				// number of events for that day
				if(!empty($dates_event_counts[$x+1])){
					$count = ($dates_event_counts[$x+1]==1)? $dates_event_counts[$x+1]: $dates_event_counts[$x+1];
					$__events = 'data-events="'.$count.'"';
				}else{$__events ='data-events="0"';}

				// data  full length day name
				$day_name = 'data-dnm="'.$this->full_day_names[$day_of_week].'"';


				$output.= "<p class='evo_day ".implode(' ', $day_classes)."' {$__events} {$day_name} data-date='".($x+1)."'>
						<span class='evo_day_name'>".$this->day_names[$day_of_week]."</span><span class='evo_day_num'>".($x+1)."</span>
					</p>";
				
			}
			$output.= "<div class='clear'></div>";
			
			return $output;
			//return ob_get_clean();
		}
		
	
	
	
	// add daily view hidden field to calendar header
		function calendar_header_hook($content){
			// check if daily view is running on this calendar
			if($this->is_running_dv){			
				
				$day_data = $this->focus_day_data;

				$_cal_focus_day = (!empty($this->focus_day_data['mo1st']) && $this->focus_day_data['mo1st'] =='yes')? 1:$this->focus_day_data['day'];

				// Move to first of month class
				$mo1st_class = (!empty($this->focus_day_data['mo1st']) && $this->focus_day_data['mo1st'] =='yes')? ' mo1st':null;

				$add = "<input type='hidden' class='eventon_other_vals{$mo1st_class} evoDV' name='dv_focus_day' data-day='".$day_data['day']."' value='".$_cal_focus_day."'/>";
				
				echo $add;

				$this->print_scripts();
			}else{

				//wp_dequeue_script('evo_dv_script');
				//wp_dequeue_script('evo_dv_mousewheel');
			}

		}
	
			
			
	
	
	// SECONDARY FUNCTIONS
		// ONLY for DV calendar actions 
		public function only_dv_actions($args){

			$this->shortcode_args = $args;
			if(!empty($args['today']) && $args['today']!='yes')
				add_action('eventon_after_loadbar',array( $this, 'content_below_sortbar_this' ), 10,1);
			add_filter('eventon_cal_class', array($this, 'eventon_cal_class'), 10, 1);				
		}

		public function remove_dv_only_actions(){
			remove_filter('eventon_cal_class', array($this, 'eventon_cal_class'));	
		}

		// add class name to calendar header for DV
			function eventon_cal_class($name){
				if(!empty($this->shortcode_args['today']) && $this->shortcode_args['today']=='yes')
					$name[]='evoDVtoday';
				$name[]='evoDV';
				return $name;
			}
		

		// three letter day array
			function set_three_letter_day_names($lang=''){
				
				// Build 3 letter day name array to use in the fullcal from custom language
				for($x=1; $x<8; $x++){			
					$evcal_day_is[$x] =eventon_return_timely_names_('day_num_to_name',$x, 'three', $lang);			
				}	
				
				$this->day_names = $evcal_day_is;
			}

		// full length day array
			function set_full_day_names($lang=''){
				
				// Build 3 letter day name array to use in the fullcal from custom language
				for($x=1; $x<8; $x++){			
					$evcal_full_day_is[$x] =eventon_return_timely_names_('day_num_to_name',$x, 'full', $lang);			
				}	
				
				$this->full_day_names = $evcal_full_day_is;
			}

		// full length day array
			function get_full_day_names($dayofweekN, $lang=''){						
				return eventon_return_timely_names_('day_num_to_name',$dayofweekN, 'full', $lang);	
				
			}


		//	Styles for the tab page
		public function register_styles_scripts(){

			wp_register_style( 'evo_dv_styles',$this->plugin_url.'/assets/dv_styles.css');		
			wp_register_script('evo_dv_mousewheel',$this->plugin_url.'/assets/jquery.mousewheel.min.js', array('jquery'), 1.0, true );
			wp_register_script('evo_dv_script',$this->plugin_url.'/assets/dv_script.js', array('jquery'), 1.0, true );		
						

			if(has_eventon_shortcode('add_eventon_dv')){
				// LOAD JS files
				$this->print_scripts();
			}



			add_action( 'wp_enqueue_scripts', array($this,'print_styles' ));
				
		}
		public function print_scripts(){	
			wp_enqueue_script('evo_dv_mousewheel');
			wp_enqueue_script('evo_dv_script');		
				
		}

		function print_styles(){
			wp_enqueue_style( 'evo_dv_styles');	
		}




	
	// ACTIVATION		
			
		function activate(){
			// add actionUser addon to eventon addons list
			$this->addon->activate();
		}
		
	
		// Deactivate addon
		function deactivate(){
			$this->addon->remove_addon();
		}

	function days_in_month($month, $year) { 
		return date('t', mktime(0, 0, 0, $month+1, 0, $year)); 
	}
	
			
		
		
}

// Initiate this addon within the plugin
$GLOBALS['eventon_dv'] = new EventON_daily_view();


// php tag
function add_eventon_dv($args=''){
	
	global $eventon_dv;

	echo $eventon_dv->shortcodes->evoDV_generate_calendar($args);
}


?>