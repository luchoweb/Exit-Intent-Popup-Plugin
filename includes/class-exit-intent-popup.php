<?php

class Exit_Intent_Popup {
	
	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		if ( defined( 'EXIT_INTENT_POPUP_VERSION' ) ) {
			$this->version = EXIT_INTENT_POPUP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'exit-intent-popup';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-exit-intent-popup-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-exit-intent-popup-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-exit-intent-popup-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-exit-intent-popup-public.php';

		$this->loader = new Exit_Intent_Popup_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Exit_Intent_Popup_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Exit_Intent_Popup_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	private function define_public_hooks() {

		$plugin_public = new Exit_Intent_Popup_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
