<?php
  
// ======================================================================== //		
// PHP Version notice if version < 7.0
// ======================================================================== // 

    function php_version_notice() {
        $class = 'notice notice-error';
        $message = __( '<strong>Bootstrap 4 Shortcodes for WordPress</strong> requires PHP version 7.0 or later. You are running PHP version ' . PHP_VERSION . '. Please upgrade to a supported version of PHP.', 'sample-text-domain' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
    }

    //Only run this if the PHP version is less than 7.0
    if (version_compare(PHP_VERSION, '7.0.0', '<')) {
        add_action( 'admin_notices', 'php_version_notice' );
    }

// ======================================================================== // 

// ======================================================================== //
// Enqueue help button styles
// ======================================================================== //

    function bootstrap_shortcodes_styles_all() {
        wp_register_style( 'bootstrap-shortcodes-help-all', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/bootstrap-shortcodes-help-all.css' ) );
        wp_enqueue_style( 'bootstrap-shortcodes-help-all' );
    }

    add_action( 'admin_enqueue_scripts', 'bootstrap_shortcodes_styles_all' );

// ======================================================================== //


// ======================================================================== //		
// Function and filter to remove extra line breaks around shortcodes
// ======================================================================== // 

    function bs_fix_shortcodes($content){   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']',
            '<br />[' => '[',
            ']<br>' => ']',
            '<br>[' => '[',
            '<200b>' => ''
        );

        $content = strtr($content, $array);
        $content = preg_replace('/<br \/>[\n\r\s]+\[/', '[', $content);
        return $content;
    }

    add_filter('the_content', 'bs_fix_shortcodes');

// ======================================================================== // 




// ======================================================================== //		
// Include the help popup content in the footer
// ======================================================================== // 

    function bootstrap_shortcodes_help() {
        include( BS_SHORTCODES_DIR . 'bootstrap-shortcodes-help.php');
    }

    add_action( 'admin_footer-post.php', 'bootstrap_shortcodes_help' );
    add_action( 'admin_footer-post-new.php', 'bootstrap_shortcodes_help' );


// ======================================================================== // 



// ======================================================================== //		
// Add the Bootstrap Shortcodes button to Distraction Free Writing mode 
// ======================================================================== //

    function bs_fullscreenbuttons($buttons) {
        $buttons[] = 'separator';
        $buttons['bootstrap-shortcodes'] = array(
            'title' => __('Bootstrap 4 Shortcodes Help'),
            'onclick' => "jQuery('#bootstrap-shortcodes-help').modal('show');",
            'both' => false 
        );
        return $buttons;
    }

    add_action ('wp_fullscreen_buttons', 'bs_fullscreenbuttons');

// ======================================================================== //



// ======================================================================== //		
// Gravity Forms is bossy.
// Register this script with Gravity Forms (if present) so it isn't stripped out
// ======================================================================== //

    function bs_register_script($scripts){
        $scripts[] = "bootstrap-shortcodes-help-all";
        return $scripts;
    }

    add_filter("gform_noconflict_styles", "bs_register_script");

// ======================================================================== //


// ======================================================================== //		
// Register this script with TinyMCE
// ======================================================================== //
    function register_bs_buttons_editor($buttons)
    {
        //register buttons with their id.
        array_push($buttons, "bs_help_button");
        return $buttons;
    }


// ======================================================================== //		
// Button creation and styles for the documentation popup button
// ======================================================================== // 

    function enqueue_bs_plugin_scripts($plugin_array)
    {
        wp_register_style( 'bootstrap-shortcodes-help', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/bootstrap-shortcodes-help.css' ) );
        wp_register_script( 'bootstrap', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/js/bootstrap.bundle.min.js' ) );
        wp_register_style( 'fontawesome', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/fontawesome.min.css' ) );
        wp_enqueue_style( 'bootstrap-shortcodes-help' );
        wp_enqueue_script( 'bootstrap' );
        wp_enqueue_style( 'fontawesome' );

        //enqueue TinyMCE plugin script with its ID.
        $plugin_array["bs_button_plugin"] =  plugin_dir_url(__FILE__) . "js/tinymce.js";
        return $plugin_array;
    }

    //add the button to the content editor, next to the media button on any admin page in the array below
    if(in_array(basename($_SERVER['PHP_SELF']), array('post.php', 'page.php', 'page-new.php', 'post-new.php', 'widgets.php', 'admin-ajax.php'))) {
        add_filter("mce_buttons", "register_bs_buttons_editor");
        add_filter("mce_external_plugins", "enqueue_bs_plugin_scripts");
    }



    function sidebar_plugin_register() {
        wp_register_script(
            'plugin-sidebar-js',
            plugins_url( 'js/plugin-sidebar.js', __FILE__ ),
            array( 'wp-plugins', 'wp-edit-post', 'wp-element' )
        );
    }
    add_action( 'init', 'sidebar_plugin_register' );
     
    function sidebar_plugin_script_enqueue() {
        wp_enqueue_script( 'plugin-sidebar-js' );
    }
    add_action( 'enqueue_block_editor_assets', 'sidebar_plugin_script_enqueue' );




    function add_bs4_button() {
        global $pagenow;
	if( isset( $pagenow) &&  $pagenow=='admin-ajax.php' ) return ;

        wp_register_style( 'bootstrap-shortcodes-help', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/bootstrap-shortcodes-help.css' ) );
        wp_register_style( 'bootstrap', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/bootstrap.min.css' ) );
        wp_register_script( 'bootstrap', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/js/bootstrap.bundle.min.js' ) );
        wp_enqueue_style( 'bootstrap-shortcodes-help' );
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_script( 'bootstrap' );


        echo '<button type="button" data-toggle="modal" data-target="#bootstrap-shortcodes-help"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAA3lBMVEUAAABZPXpWPXxWPHxWPXxXPHxXQHpVPn1WPXxWPXxXPX1WPXxWPXxWPXxWPXxWPXxVPn1TO31WPn1VPXlWPXxZQX9hSoWKeKT////o5e64rshqVIv29fh9apr8/P27scvCudDg2+fo5O1XP335+Pqom7t1YZRgSISGdKFbQ4D9/f2Ofqjk4er6+vt4ZJaCcJ6qnr339vn08/fx7/T7+vyvo8H6+fttV417aJmzqMSUhazi3uh4ZZf+/v55ZZetob/8+/xcRIFxW5Grnr7Nxtjz8fbTzN2xpsOai7BwW5A5ZpDEAAAAFHRSTlMALqbo56UsWvn4WKT+/eajLStWKigdCssAAAABYktHRBibaYUeAAAAB3RJTUUH4wsICSsl3MXI0wAAAOtJREFUOMuF03tTgkAUBfArKgYaWK52yxS1oiylh1r5Rsoe3/8LuWg4NS1nz187ww84u3OXiDJGViiTy5skUzgQqbFs+T54LoVJhoApUhaDHJUwKFGyqtaS/BV7cML7nJ7VMWA+byhB04vTakvRuVCBy5/llRQ+AtcS3CDQvdV84Y65p+zQD+LcPzzyU4C3OfB15zAcKcHzyzavY1lygkqKEfMUghnzvIvAQtaoI7BkDleqkrt5iN5C5ne8TV5HGHxE/8/B95J8fn3/HjnN0B7qxt6hPAYulS149Y6IbCCs4/h6m0Un5f9uhWgDHJpYkq/KzR0AAAAldEVYdGRhdGU6Y3JlYXRlADIwMTktMTEtMDhUMDk6NDM6MzcrMDA6MDCC18JaAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE5LTExLTA4VDA5OjQzOjM3KzAwOjAw84p65gAAAABJRU5ErkJggg=="></button>';
}

add_action('media_buttons', 'add_bs4_button', 15);

// ======================================================================== // 
