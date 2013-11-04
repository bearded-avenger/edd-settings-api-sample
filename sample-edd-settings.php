<?php

class sampleEDDOpts {

	function __construct() {

		add_filter( 'edd_settings_tabs', array($this,'test_tab' ));
		add_action('admin_init', array($this,'edd_register_settings_test'));
	}

	/* EDD Settings API has built in callbacks for option types and sanitization
	*
	* edd_checkbox_callback
	* edd_multicheck_callback
	* edd_radio_callback
	* edd_gateways_callback
	* edd_gateway_select_callback
	* edd_text_callback
	* edd_textarea_callback
	* edd_password_callback
	* edd_select_callback
	* edd_color_select_callback
	* edd_color_callback
	* edd_rich_editor_callback
	* edd_upload_callback
	* edd_shop_states_callback
	* edd_tax_rates_callback
	* edd_license_key_callback
	*/

	/*
	*  Register multiple options with add_settings_field
	*
	*/

	/*
	*  Retrieve options like this
	*
	*  $opts = get_option('edd_options');
	*  echo $opts['test'];
	*  echo $opts['another']
	*
	*/

	function test_tab( $tabs ) {

		$ns = 'uniquetoyourshit';

	    $tabs[$ns] = 'Balls Awesome';

	    return $tabs;
	}

	function edd_register_settings_test() {

		$ns = 'uniquetoyourshit';

	    add_settings_section(
	        'edd_settings_'.$ns, // edd_settings_XXX - xxx is the tab name
	        __return_null(),
	        '__return_false',
	        'edd_settings_'.$ns // edd_settings_XXX - xxx is the tab name
	    );

	    // location

	    add_settings_field(
	        'edd_settings[test]', // "test" should be unique to this specific option
	        'Wow Option Name',   // NAME of the option
	        'edd_text_callback', // built in callbacks see https://github.com/easydigitaldownloads/Easy-Digital-Downloads/blob/master/includes/admin/settings/register-settings.php for a full list
	        'edd_settings_'.$ns, // edd_settings_XXX - xxx is the tab name
	        'edd_settings_'.$ns, // edd_settings_XXX - xxx is the tab name
	        array(
	            'id'      => 'test', // should match the id in teh serialized optoin array
	            'desc'    => 'First Desc',
	            'name'    => 'Wow Option Name',  // NAME of the option
	            'section' => $ns // "test" should be unique to this specific option
	        )
	    );

	    // shows how to add another optoin. notice the [ID], 'id', and 'section' all match
	    add_settings_field(
	        'edd_settings[another]',
	        'So cool',
	        'edd_text_callback',
	        'edd_settings_'.$ns,
	        'edd_settings_'.$ns,
	        array(
	            'id'      => 'another',
	            'desc'    => 'First Desc',
	            'name'    => 'Another Sweet',
	            'section' => $ns
	        )
	    );

	}

}
new sampleEDDOpts;