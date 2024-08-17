<?php 
/**
 * The header for our theme
 *
 * @package Your_Startup
 */
get_header();

 require_once (get_template_directory() . '/client/.output/public/index.html');

get_footer();