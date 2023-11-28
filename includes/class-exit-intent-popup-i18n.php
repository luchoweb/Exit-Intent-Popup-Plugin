<?php

class Exit_Intent_Popup_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'exit-intent-popup',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
