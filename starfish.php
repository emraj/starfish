<?php

/**
 * Plugin Name: Starfish
 * Plugin URI: www.umidigital.co.uk
 * Description: A performance index plugin for websites on the Umi Reef.
 * Version: 0.2.0
 * Author: S. M. Sirajo
 * Author URI: www.umidigital.co.uk
 * License: GPL2
 */

function main_call()
{
	echo ("<h3> Website Performance Index Plugin<br> for Reef's Sites </h3>");
}

function display_admin()
{
    require('starfish_admin.php');
}

function starfish_admin_actions()
{
    add_menu_page( 'Starfish | umiApps', 'Starfish Index', 'manage_options', 'starfish/starfish.php', 'display_admin', 'dashicons-star-filled', '71.5');
}

add_action('admin_menu', 'starfish_admin_actions');

?>