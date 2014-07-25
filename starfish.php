<?php

/**
 * Plugin Name: Starfish
 * Plugin URI: reef.umiapps.com
 * Description: A performance index plugin for websites on the Umi Reef.
 * Version: 0.2.0
 * Author: S. M. Sirajo
 */

function main_call()
{
	echo ("<h3> Website Performance Index Plugin<br> for Reef's Sites </h3>");
}

function display_dashboard()
{
    require ('dashboard.php');
}

function starfish_admin_actions()
{
    add_menu_page( 'Starfish | umiApps', 'Performance Index', 'manage_options', 'starfish.php', 'display_dashboard', 'dashicons-star-filled', '71.5');
}

add_action('admin_menu', 'starfish_admin_actions');

?>