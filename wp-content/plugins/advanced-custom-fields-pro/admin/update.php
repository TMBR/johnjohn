<?php 

class acf_update {

	/*
	*  __construct
	*
	*  A good place to add actions / filters
	*
	*  @type	function
	*  @date	11/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/
	
	function __construct() {
		
		// actions
		add_action('admin_menu', array($this,'admin_menu'), 20);
		
		
		// insert our update info into the update array maintained by WP
		add_filter('site_transient_update_plugins', array($this, 'inject_downgrade'));
		
		
		// ajax
		add_action('wp_ajax_acf/admin/data_upgrade',	array($this, 'ajax_upgrade'));
	}
	
	
	
	/*
	*  ajax_upgrade
	*
	*  description
	*
	*  @type	function
	*  @date	24/10/13
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function ajax_upgrade() {
		
   		// options
   		$options = acf_parse_args( $_POST, array(
			'version'	=>	'',
			'nonce'		=>	'',
		));
		
		
		// validate
		if( ! wp_verify_nonce($options['nonce'], 'acf_nonce') ) {
		
			wp_send_json_error();
			
		}
		
		
		// vars
		$path = acf_get_path("admin/updates/{$options['version']}.php");
		
		
		// load version
		if( !file_exists( $path ) ) {
		
			wp_send_json_error();
			
		}
		
		
		// load any errors / feedback from update
		ob_start();
		
		
		// include
		include( $path );
		
		
		// get feedback
		$feedback = ob_get_clean();
		
		
		// update successful
		update_option('acf_version', $options['version'] );
		
		
		// check for relevant updates. If none are found, update this to the plugin version
		$updates = acf_get_updates();
		if( empty($updates) ) {
		
			update_option('acf_version', acf_get_setting('version'));
			
		}
		
		
		// return
		wp_send_json_success(array(
			'feedback' => $feedback
		));			
	}
	
	
	/*
	*  admin_menu
	*
	*  description
	*
	*  @type	function
	*  @date	19/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function admin_menu() {
		
		// bail early if no show_admin
		if( !acf_get_setting('show_admin') ) {
			
			return;
		
		}
		
		
		// update admin page
		$page = add_submenu_page('edit.php?post_type=acf-field-group', __('Upgrade','acf'), __('Upgrade','acf'), acf_get_setting('capability'),'acf-upgrade', array($this,'html') );
		
		
		// vars
		$plugin_version = acf_get_setting('version');
		$acf_version = get_option('acf_version');

		
		// bail early if a new install
		if( empty($acf_version) ) {
		
			update_option('acf_version', $plugin_version );
			return;
			
		}
		
		
		// bail early if $acf_version is >= $plugin_version
		if( version_compare( $acf_version, $plugin_version, '>=') ) {
		
			return;
			
		}
		
		
		// bail early if no updates available
		$updates = acf_get_updates();
		if( empty($updates) ) {
			
			update_option('acf_version', $plugin_version );
			return;
			
		}
		
		
		// actions
		add_action( 'admin_notices', array( $this, 'admin_notices'), 1 );
		
		
		
		/*
		
		// vars
		$l10n = array(
			'h4'	=> __('Data Upgrade Required', 'acf'),
			'p'		=> sprintf(__('%s %s requires some updates to the database', 'acf'), acf_get_setting('name'), $plugin_version),
			'a'		=> __( 'Run the updater', 'acf' )
		);
		
		
		
// add notice
		$message = '
		<h4>' . $l10n['h4'] . '</h4>
		<p>' . $l10n['p'] . '
			<a id="acf-run-the-updater" href="' . admin_url('edit.php?post_type=acf-field-group&page=acf-upgrade') . '" class="acf-button blue">
				' . $l10n['a'] . '
			</a>
		</p>
		<script type="text/javascript">
		(function($) {
			
			$("#acf-run-the-updater").on("click", function(){
		
				var answer = confirm("'. __( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'acf' ) . '");
				return answer;
		
			});
			
		})(jQuery);
		</script>';
		
		acf_add_admin_notice( $message, 'acf-update-notice', '' );
*/
		
		
	}
	
	
	/*
	*  admin_notices
	*
	*  This function will render any admin notices
	*
	*  @type	function
	*  @date	17/10/13
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function admin_notices() {
		
		// view
		$view = array(
			'updates'	=> acf_get_updates(),
			'version'	=> acf_get_setting('version'),
			'rollback'	=> get_option('acf_version'),
			'pro'		=> acf_get_setting('pro'),
			'basename'	=> acf_get_setting('basename'),
			'addons'	=> array()
		);
		
		
		// add-ons
		$addons = array(
			'acf-flexible-content'	=> 'Flexible Content Field',
			'acf-gallery'			=> 'Gallery Field',
			'acf-options-page'		=> 'Options Page',
			'acf-repeater'			=> 'Repeater Field',
		);
		
		
		// get active plugins
		$plugins = implode(' ', get_option('active_plugins'));
		
		foreach( $addons as $k  => $v ) {
			
			if( strpos($plugins, $k) !== false ) {
				
				$view['addons'][] = $v;
			}
			
		}
		
		
		// load view
		acf_get_view('update-notice', $view);
		
	}
	
	
	/*
	*  html
	*
	*  description
	*
	*  @type	function
	*  @date	19/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function html() {
		
		// view
		$view = array(
			'updates' => acf_get_updates()
		);
		
		
		// load view
		acf_get_view('update', $view);
		
	}
	
	
	/*
	*  inject_downgrade
	*
	*  description
	*
	*  @type	function
	*  @date	16/01/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function inject_downgrade( $transient ) {
		
		// bail early if no plugins are being checked
	    if( empty($transient->checked) )  {
	    
            return $transient;
            
        }
		
		
		// bail early if no nonce
		if( empty($_GET['_acfrollback']) ) {
			
			return $transient;
			
		}
		
		
		// vars
		$rollback = get_option('acf_version');
		
		
		// bail early if nonce is not correct
		if( !wp_verify_nonce( $_GET['_acfrollback'], 'rollback-acf_' . $rollback ) ) {
			
			return $transient;
			
		}
		
		
		// create new object for update
        $obj = new stdClass();
        $obj->slug = $_GET['plugin'];
        $obj->new_version = $rollback;
        $obj->url = 'https://wordpress.org/plugins/advanced-custom-fields';
        $obj->package = 'http://downloads.wordpress.org/plugin/advanced-custom-fields.' . $rollback . '.zip';;
        
        
        // add to transient
        $transient->response[ $_GET['plugin'] ] = $obj;
        
		
		// return 
        return $transient;
	}
			
}

new acf_update();

?>
