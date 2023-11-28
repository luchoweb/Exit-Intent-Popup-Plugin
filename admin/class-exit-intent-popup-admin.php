<?php

class Exit_Intent_Popup_Admin {
	private $plugin_name;
	private $version;
	private $table_name;

	public function __construct( $plugin_name, $version ) {
		global $wpdb;

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->table_name = $wpdb->base_prefix.'exit_intent_popup';

		add_action('admin_menu', array($this, 'addAdminMenuItems'), 9);
		add_action('wp_ajax_submit_popup_data', array($this, 'submit_popup_data'));
		add_action('wp_ajax_get_popup_data', array($this, 'get_popup_data'));
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/exit-intent-popup-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/exit-intent-popup-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function addAdminMenuItems() {
		add_menu_page(
			$this->plugin_name,
			'Exit Popup',
			'administrator',
			$this->plugin_name,
			array(
				$this,
				'displayAdminDashboard',
			),
			'dashicons-external',
			20
		);
	}

	public function displayAdminDashboard() {
		include 'partials/exit-intent-popup-admin-display.php';
	}

	public function submit_popup_data() {
		global $wpdb;

		$data_where = array('id' => 1);

		if(isset($_POST['title'])){
			$data = array(
				'title' => $_POST['title'],
				'subhead' => $_POST['subhead'],
				'content' => $_POST['content'],
				'image' => $_POST['image'],
			);

			$wpdb->update($this->table_name, $data, $data_where);
			wp_die();
		}
	}

	public function get_popup_data() {
		global $wpdb;

		$data = $wpdb->get_row("SELECT * FROM `".$this->table_name."` WHERE id = 1");

		echo json_encode($data);

		wp_die();
	}
}
