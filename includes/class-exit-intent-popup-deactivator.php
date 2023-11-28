<?php

class Exit_Intent_Popup_Deactivator {

	public static function deactivate() {
		setcookie("exit-intent", "", time() - 3600, "/");

		global $wpdb;
    $table_name = $wpdb->base_prefix.'exit_intent_popup';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
	}

}
