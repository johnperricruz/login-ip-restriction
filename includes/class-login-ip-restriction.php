<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.johnperricruz.com
 * @since      1.0.0
 *
 * @package    Login_Ip_Restriction
 * @subpackage Login_Ip_Restriction/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Login_Ip_Restriction
 * @subpackage Login_Ip_Restriction/includes
 * @author     John Perri Cruz <johnperricruz@gmail.com>
 */
class Login_Ip_Restriction {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Login_Ip_Restriction_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'login-ip-restriction';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Login_Ip_Restriction_Loader. Orchestrates the hooks of the plugin.
	 * - Login_Ip_Restriction_i18n. Defines internationalization functionality.
	 * - Login_Ip_Restriction_Admin. Defines all hooks for the admin area.
	 * - Login_Ip_Restriction_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-login-ip-restriction-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-login-ip-restriction-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-login-ip-restriction-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-login-ip-restriction-public.php';

		$this->loader = new Login_Ip_Restriction_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Login_Ip_Restriction_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Login_Ip_Restriction_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Login_Ip_Restriction_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Login_Ip_Restriction_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
		$this->execute_hooks();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Login_Ip_Restriction_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	public function add_fields_to_user(){ 
		$user_id = $_GET['user_id'];
		?>
			<h3><?php _e("User IP Address Access Restriction", "blank"); ?></h3>
			<table class="form-table">
			<tr>
				<th><label for="address"><?php _e("IP Address"); ?></label></th>
				<td>
					<textarea name="ip_address" id="ip_address" value="<?php echo the_author_meta( 'ip_address', $user_id ); ?>" class="regular-text" ><?php echo the_author_meta( 'ip_address', $user_id ); ?></textarea><br />
					<span class="description"><?php _e("<br/> 1. For IP Range calculator, use <a href='http://networkcalculator.ca/ip-calculator.php' target='_blank'>this site.</a>  <br/>2. Each IP Address must be Separated by comma"); ?></span>
				</td>
			</tr>
			</table>
		<?php		
	}
	public function add_fields_to_profile(){
		$user_id = get_current_user_id(); 
		?>
			<h3><?php _e("Profile IP Address Access Restriction", "blank"); ?></h3>
			<table class="form-table">
			<tr>
				<th><label for="address"><?php _e("IP Address"); ?></label></th>
				<td>
					<textarea name="ip_address" id="ip_address" value="<?php echo the_author_meta( 'ip_address', $user_id ); ?>" class="regular-text" ><?php echo the_author_meta( 'ip_address', $user_id ); ?></textarea><br />
					<span class="description"><?php _e("<br/> 1. For IP Range calculator, use <a href='http://networkcalculator.ca/ip-calculator.php' target='_blank'>this site.</a>  <br/>2. Each IP Address must be Separated by comma"); ?></span>
				</td>
			</tr>
			</table>
		<?php		
	}
	function login_restriction( $user, $password ){
		$ip_add_textarea = get_user_meta($user->ID, 'ip_address',true);
		$ip_add_array = explode(",",$ip_add_textarea);
		$client_ip = $this->get_client_ip();
		 
		$response = false;
		
		if($ip_add_textarea!=null){
			//parse Array
			foreach($ip_add_array as $allowed){
				 
				//Parse Array Notation
				if(strpos($allowed, '/') !== false){
					$ip_range = $this->extract_ip_from_range($allowed);
					foreach($ip_range as $allowed2){
						if($allowed2 == $client_ip){
							$response = true;
							break 2;
						}else{
							$response = false;
						}
					}
				}
				if($allowed == $client_ip){
					$response = true;
					break;
				}else{
					$response = false;
				}
			}
			if($response){
				//Log in
				return $user;
			}else{
				return new WP_Error( 'denied', __("You can not login using IP Address : <b>".$client_ip."</b> ") );
			}
		}else{
			return $user;
		}
	}
	function extract_ip_from_range($range){ 
		$parts = explode('/',$range);
		$exponent = 32-$parts[1].'-';
		$count = pow(2,$exponent);
		$start = ip2long($parts[0]);
		$end = $start+$count;
		return array_map('long2ip', range($start, $end) );
	}
	function get_client_ip(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}
	function save_user_ip_address($user_id) {
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false; 
		update_user_meta ( $user_id, 'ip_address', $_POST['ip_address'] );
	}	
	function save_profile_ip_address() {
		$user_id = get_current_user_id(); 
		update_user_meta ( $user_id, 'ip_address', $_POST['ip_address'] );
	}
	public function execute_hooks(){
		//Field Hooks
		add_action( 'show_user_profile',array(&$this,'add_fields_to_profile')); //Your Profile
		add_action( 'edit_user_profile',array(&$this,'add_fields_to_user'));
		
		//Saving Hooks
		add_action( 'personal_options_update',array(&$this,'save_profile_ip_address')); //Save Your Profile
		add_action( 'edit_user_profile_update',array(&$this,'save_user_ip_address')); //Save User Profile
		
		//Authenticate User
		add_filter('wp_authenticate_user', array(&$this,'login_restriction'));
	}

}
 