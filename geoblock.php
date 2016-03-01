<?php
namespace Abdussamad\WordPress\Plugins;
/*
Plugin Name: GeoIP content blocker
Description: Block content based on the user's geographical location. Enter country codes separated by commas like this: [geoblock type='blacklist' countries='pk,in']. Type can be blacklist or whitelist
Author: Abdussamad Abdurrazzaq
Author URI: https://abdussamad.com
Plugin URI: https://abdussamad.com/archives/1058-Country-specific-content-blocks-for-WordPress.html
Version: 0.4.1
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License version 2
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

License Details: http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
*/

class geoblocker {
	function __construct() {
		add_shortcode( 'geoblock', array( $this, 'shortcode_handler' ) );
	}
	
	public function shortcode_handler(  $atts, $content = '' ) {
		extract( shortcode_atts( 	array(
											'type'      => 'blacklist',
											'countries' => 'pk',
											'message'   => ''
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
			$content = esc_html( $message );
		}
		return $content;
	}
}

new geoblocker;