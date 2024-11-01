<?php
/*
Plugin Name: Filemarket Shortcode
Plugin URI: http://filemarket.online
Description: Easy way of embedding http://filemarket.online payment buttons
Version: 0.1
Author: Pavel Petrov
Author URI: http://webbamboo.net
License: GPL2
*/

class WB_Filemarket_Shortcode {
    private static $instance = null;
    private $plugin_path;
    private $plugin_url;
    private $text_domain = '';

    /**
    * Creates or returns an instance of this class.
    */
    public static function get_instance() {
        // If an instance hasn't been created and set to $instance create an instance and set it to $instance.
        if ( null == self::$instance ) {
        self::$instance = new self;
        }
        return self::$instance;
    }

    /**
    * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
    */
    private function __construct() {
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url = plugin_dir_url( __FILE__ );

        global $wpdb;
        load_plugin_textdomain( $this->text_domain, false, 'lang' );
        //Hooks and filters
        add_shortcode( 'filemarket', array($this, 'wb_filemarket_shortcode' ) );
    }
    
    public function wb_filemarket_shortcode( $atts )
    {
        $return = $atts["return"] ? "<input type='hidden' name='return' value='".$atts["return"]."' >" : "";
        ob_start();
	    ?> 
	    <style>
        .wb_filemarket_button{display:inline-block;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;cursor:pointer;padding:.75em 1em;border:none;-webkit-border-radius:2px;border-radius:2px;font:400 1.25em/normal Abel,Helvetica,sans-serif;color:rgba(255,255,255,1);-o-text-overflow:clip;text-overflow:clip;background:#62ac15;text-shadow:0 -1px 0 #5b8111}.wb_filemarket_button:hover{background:#6fba22;-webkit-transition:all .2s cubic-bezier(.42,0,.58,1) 10ms;-moz-transition:all .2s cubic-bezier(.42,0,.58,1) 10ms;-o-transition:all .2s cubic-bezier(.42,0,.58,1) 10ms;transition:all .2s cubic-bezier(.42,0,.58,1) 10ms}.wb_filemarket_button:active{background:#62ac15;-webkit-box-shadow:0 1px 4px 0 #416917 inset;box-shadow:0 1px 4px 0 #416917 inset;-webkit-transition:none;-moz-transition:none;-o-transition:none;transition:none}
	    </style>
	    <form method="POST" action="http://filemarket.online/remote/<?= $atts['id'] ?>"><?= $return ?><button type="submit" class="wb_filemarket_button">Buy it now</button></form><br>
	    <?php
	    return ob_get_clean();
    }  
    
}
WB_Filemarket_Shortcode::get_instance();
