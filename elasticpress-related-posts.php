<?php
/**
 * Plugin Name: ElasticPress Related Posts
 * Description: Show related post in admin post screen.
 * Version:     1.0
 * Author:      Phil Pérusse
 * Author URI:  https://github.com/philperusse
 * License:     GPLv2 or later
 */


require_once ( 'classes/Elasticpress_related_posts.php' );

add_action( 'after_setup_theme', function(){

    if(! is_admin() || ! defined('EP_VERSION'))
        return;

    Elasticpress_related_posts::instance();

});