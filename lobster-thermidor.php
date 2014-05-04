<?php
/*
Plugin Name: Lobster Thermidor
Plugin URI: https://github.com/imagentleman/lobster-thermidor
Description: Simplest but not simpler anti-spam plugin.
Author: Imagentleman
Version: 1
*/

define( 'SPAM_WORDS', serialize( array(
    0 => 'http://',
    1 => 'https://',
)) );

function activate() {
	$blacklist = get_option( 'blacklist_keys' );
	$words = explode( "\n", $blacklist );
	$spam_words = unserialize( SPAM_WORDS );
	foreach ( $spam_words as $w ) {
		if ( !in_array( $w, $words ) ) {
			array_push( $words, $w );
		}
	}
	$blacklist = implode("\n", $words);
	update_option( 'blacklist_keys', $blacklist );
}

register_activation_hook( __FILE__, 'activate' );
