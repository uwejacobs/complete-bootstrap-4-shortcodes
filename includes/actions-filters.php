<?php
  
// ======================================================================== //		
// PHP Version notice if version < 5.3
// ======================================================================== // 

    function php_version_notice() {
        $class = 'notice notice-error';
        $message = __( '<strong>Bootstrap 4 Shortcodes for WordPress</strong> requires PHP version 5.3 or later. You are running PHP version ' . PHP_VERSION . '. Please upgrade to a supported version of PHP.', 'sample-text-domain' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
    }

    //Only run this if the PHP version is less than 5.3
    if (version_compare(PHP_VERSION, '5.3.0', '<')) {
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
            ']<br>' => ']'
        );

        $content = strtr($content, $array);
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

    add_action( 'admin_footer', 'bootstrap_shortcodes_help' );

// ======================================================================== // 



// ======================================================================== //		
// Add the Bootstrap Shortcodes button to Distraction Free Writing mode 
// ======================================================================== //

    function bs_fullscreenbuttons($buttons) {
        $buttons[] = 'separator';
        $buttons['bootstrap-shortcodes'] = array(
            'title' => __('Bootsrap 4 Shortcodes Help'),
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
        wp_register_script( 'bootstrap', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/js/bootstrap.min.js' ) );
        wp_register_script( 'popper', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/js/popper.min.js' ) );
        wp_register_style( 'fontawesome', plugins_url( 'complete-bootstrap-4-shortcodes/includes/help/css/fontawesome.min.css' ) );
        wp_enqueue_style( 'bootstrap-shortcodes-help' );
        wp_enqueue_script( 'popper' );
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
// ======================================================================== // 
