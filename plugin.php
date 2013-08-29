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

yourls_add_filter('admin_url', 'admin_url_filter');
function admin_url_filter( $admin, $page ) {
	$admin = ADMIN_URL . $page;
	if( yourls_is_ssl() or yourls_needs_ssl() )
		$admin = str_replace('http://', 'https://', $admin);
	return $admin
}