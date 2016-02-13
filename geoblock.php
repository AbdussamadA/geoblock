<?php
namespace Abd\WordPress\Plugins;
/*
Plugin Name: GeoIP content blocker
Description: Block content based on the user's geographical location. Enter country codes separated by commas like this: [geoblock type='blacklist' countries='pk,in']. Type can be blacklist or whitelist
Author: Abdussamad
Version: 0.1
*/

class geoblocker {
	function __construct() {
		add_shortcode( 'geoblock', array( $this, 'shortcode_handler' ) );
	}
	
	public function shortcode_handler(  $atts, $content = '' ) {
		extract( shortcode_atts( 	array(
											'type'      => 'blacklist',
											'countries' => 'pk'
									), $atts 
							) 
				);
		$user_country = $_SERVER[ 'GEOIP_COUNTRY_CODE' ];	
		
		$blacklist = $type == 'blacklist' ? true: false;
		
		$countries = explode( ',', $countries );
		
		if( $blacklist ) {
			$show_content = true;
		} else {
			$show_content = false;
		}
		
		foreach( $countries as $country ) {
				if( strtoupper( trim( $country ) ) == $user_country ) {
					$show_content = !$show_content;
					break;
				}
		}
		
		if( $show_content ) {
			$content = apply_filters( 'the_content', $content );
		} else {
			$content = '';
		}
		return $content;
	}
}

new geoblocker;