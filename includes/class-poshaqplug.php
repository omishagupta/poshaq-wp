<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link        http://getposhaq.com/
 * @since      1.0.0
 *
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
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
 * @package    Poshaqplug
 * @subpackage Poshaqplug/includes
 * @author     poshaQ < http://getposhaq.com/>
 */
class Poshaqplug {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Poshaqplug_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'poshaqplug';
		$this->version = '1.0.0';
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
	 * - Poshaqplug_Loader. Orchestrates the hooks of the plugin.
	 * - Poshaqplug_i18n. Defines internationalization functionality.
	 * - Poshaqplug_Admin. Defines all hooks for the admin area.
	 * - Poshaqplug_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-poshaqplug-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-poshaqplug-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-poshaqplug-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-poshaqplug-public.php';

		$this->loader = new Poshaqplug_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Poshaqplug_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Poshaqplug_i18n();

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

		$plugin_admin = new Poshaqplug_Admin( $this->get_plugin_name(), $this->get_version() );
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

		$plugin_public = new Poshaqplug_Public( $this->get_plugin_name(), $this->get_version() );
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
		add_action('admin_menu', 'Poshaq_menu');
		add_shortcode('poshaq', 'shortcode');
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
	 * @return    Poshaqplug_Loader    Orchestrates the hooks of the plugin.
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

}	
	if (!function_exists('Poshaq_menu')) {
	function Poshaq_menu() {
	add_menu_page('Poshaq', 'poshaQ', 'manage_options', __FILE__, 'Poshaq_admin', 'dashicons-admin-site', 6);
	}
	}
	if (!function_exists('Poshaq_admin')) {
	function Poshaq_admin() {	
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/index.php';
	$myListTable = new Posts_list();
	echo '<div class="wrap"><h2>poshaQ</h2>'; 
	$myListTable->prepare_items(); 
	$myListTable->display(); 
	echo '</div>';
		}
	}
	if (!function_exists('shortcode')) 
	{
	function shortcode() {
	$request = wp_remote_get( 'http://onboarding.getposhaq.com/api/v1/posts' );
	if( is_wp_error( $request ) ) {
	return false; 
	}
	$body = wp_remote_retrieve_body( $request );
	$data = json_decode( $body );
	
	if( ! empty( $data ) ) {
	$output=array();	
	foreach( $data as $product ) {
		 
		array_push( $output, $product);
				
	}

		echo '<div class="flexslider">
				  <ul class="slides">';
				  
			foreach($output as $value){
					echo '
				
					<li>
					  <img style="width:200px" src="'.$value->suggestions.'" />
					</li>
				
				  ';

			}
			
			echo '</ul>
				</div>';
				
				
		echo '<script>
				var script = document.createElement("script");
				
				script.src = "https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js";
		document.getElementsByTagName("head")[0].appendChild(script);

		script = document.createElement("script");
		script.src = "https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.js";
		document.getElementsByTagName("head")[0].appendChild(script);

		var link = document.createElement("link");
		link.type = "text/css";
				link.rel = "stylesheet";
		link.href = "https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.css";
		document.getElementsByTagName("head")[0].appendChild(link);

		script.onload = function() {


		  $(window).load(function() {
		  $(".flexslider").flexslider({
			animation: "slide",
			animationLoop: false,
			itemWidth: 210,
			itemMargin: 5,
			minItems: 2,
			maxItems: 4
		  });
		});
		 
		  };
</script>';
	}		
	}
	}
?>