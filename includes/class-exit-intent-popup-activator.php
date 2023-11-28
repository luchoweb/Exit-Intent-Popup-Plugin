<?php

class Exit_Intent_Popup_Activator {

	public static function activate() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->base_prefix.'exit_intent_popup';

		$sql = "CREATE TABLE `$table_name` (
			id int(9) NOT NULL AUTO_INCREMENT,
			content tinytext NOT NULL,
			title text NOT NULL,
			subhead text NOT NULL,
			image varchar(255) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		$wpdb->insert( 
			$table_name, 
			array( 
				'title' => "Create your free account", 
				'subhead' => "Start for free", 
				'content' => "Access all the conversion tools you need to drive growth, in one place - for free.", 
				"image" => "https://uploads.convertflow.co/production/websites/3/VUTekkT9Qwue5hThw16R_cf-free-hero.png"
			) 
		);
	}
}
