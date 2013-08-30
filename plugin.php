<?php
/*
Plugin Name: Customize Admin URL 
Plugin URI: http://www.kennisnet.nl
Description: Customize Admin URL
Version: 0.1
Author: Frank Matheron <frankmatheron@gmail.com>
Author URI: https://github.com/fenuz
*/
if (!defined('ADMIN_URL')) {
    define('ADMIN_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/admin/');
}

if (!defined('ADMIN_URL_SITE_URL')) {
    define('ADMIN_URL_SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
}

yourls_add_filter('admin_url', 'admin_url_filter');
function admin_url_filter( $admin, $page ) {
	$admin = ADMIN_URL . $page;
	if( yourls_is_ssl() or yourls_needs_ssl() )
		$admin = str_replace('http://', 'https://', $admin);
	return $admin;
}

yourls_add_filter('site_url', 'admin_url_site_url_filter');
function admin_url_site_url_filter( $url = '' ) {
	$url = yourls_get_relative_url( $url );
	$url = trim( ADMIN_URL_SITE_URL . '/' . $url, '/' );
	
	// Do not enforce (checking yourls_need_ssl() ) but check current usage so it won't force SSL on non-admin pages
	if( yourls_is_ssl() )
		$url = str_replace( 'http://', 'https://', $url );

	return $url;
}