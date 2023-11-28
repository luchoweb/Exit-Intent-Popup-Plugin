<?php

class Exit_Intent_Popup_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('wp_footer', array($this, 'render'), 1);

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/exit-intent-popup.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-exitintent', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.exitintent.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/exit-intent-popup.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, 'my_ajax_object', array('ajax_url' => admin_url( 'admin-ajax.php')));

	}

	public function render() {
		include 'partials/exit-intent-popup-public-display.php';
	}
	
}
