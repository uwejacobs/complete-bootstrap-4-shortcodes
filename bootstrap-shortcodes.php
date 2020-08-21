<?php
/*
Plugin Name: Bootstrap 4 Wordpress Shortcodes
Plugin URI: https://github.com/uwejacobs/bt4-wp-shortcodes
Description: The plugin adds shortcodes for all Bootstrap 4 elements.
Version: 4.5.0
Author: Uwe Jacobs
Author URI:
License: MIT
*/

/* ============================================================= */

// ======================================================================== //
// Include necessary functions and files
// ======================================================================== //

		require_once( dirname( __FILE__ ) . '/includes/defaults.php' );
		require_once( dirname( __FILE__ ) . '/includes/actions-filters.php' );

// ======================================================================== //

	// Begin Shortcodes
	class BootstrapShortcodes {

	// ======================================================================== //
	// Initialize shortcodes and conditionally include opt-in Bootstrap scripts
	// ======================================================================== //

		function __construct() {

			//Initialize shortcodes
			add_action( 'init', array( $this, 'add_shortcodes' ) );

			//Conditionally include tooltip functionality (see function for conditionals)
			add_action( 'the_post', array( $this, 'bootstrap_shortcodes_tooltip_script' ), 9999 );

			//Conditionally include poppver functionality (see function for conditionals)
			add_action( 'the_post', array( $this, 'bootstrap_shortcodes_popover_script' ), 9999 );

		    if ( !defined('LIBXML_HTML_NOIMPLIED') || !defined('LIBXML_HTML_NODEFDTD') ) {
    	        define('LIBXML_HTML_NOIMPLIED', 0);
	            define('LIBXML_HTML_NODEFDTD', 0);
	            $GLOBALS['libxml_hack'] = true;
    	    }
	}

	// ======================================================================== //



	// ======================================================================== //
	// Conditionally include tooltip initialization script.
	// See details for why this is necessary here: http://getbootstrap.com/javascript/#callout-tooltip-opt-in
	//
	//  Only includes script if content contains [tooltip] shortcode
	// ======================================================================== //

			function bootstrap_shortcodes_tooltip_script()  {
					global $post;
					if( has_shortcode( $post->post_content, 'tooltip')){
						// Bootstrap tooltip js
						wp_enqueue_script( 'bootstrap-shortcodes-tooltip', BS_SHORTCODES_URL . 'js/bootstrap-shortcodes-tooltip.js', array( 'jquery' ), false, true );
					}
			}

	// ======================================================================== //



	// ======================================================================== //
	// Conditionally include popover initialization script.
	// See details for why this is necessary here: http://getbootstrap.com/javascript/#callout-popover-opt-in
	//
	//  Only includes script if content contains [popover] shortcode
	// ======================================================================== //

			function bootstrap_shortcodes_popover_script()  {
					global $post;
					if( has_shortcode( $post->post_content, 'popover')){
							// Bootstrap popover js
							wp_enqueue_script( 'bootstrap-shortcodes-popover', BS_SHORTCODES_URL . 'js/bootstrap-shortcodes-popover.js', array( 'jquery' ), false, true );
					}
			}

	// ======================================================================== //

	/*--------------------------------------------------------------------------------------
		*
		* add_shortcodes
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function add_shortcodes() {

		$shortcodes = array(
            'accordion',
			'alert',
			'badge',
			'blockquote',
			'blockquote-footer',
			'border',
			'breadcrumb',
			'breadcrumb-item',
			'button',
			'button-group',
			'button-group-outer',
			'button-toolbar',
			'card',
			'card-body',
			'card-body-outer',
			'card-columns',
			'card-deck',
			'card-footer',
			'card-group',
			'card-header',
			'card-img',
			'card-img-overlay',
			'card-outer',
			'card-subtitle',
			'card-title',
			'carousel',
			'carousel-caption',
			'carousel-item',
			'code',
			'color',
			'column',
			'column-outer',
			'container',
			'container-fluid',
			'dropdown',
			'dropdown-divider',
			'dropdown-header',
			'dropdown-item',
			'dropdown-menu',
			'figure',
			'figure-caption',
            'flex',
            'flex-item',
            'html',
			'icon',
			'icon-stack',
			'img',
			'img-gen',
			'embed-responsive',
			'jumbotron',
			'lorem-ipsum',
			'lead',
			'list-group',
			'list-group-item',
			'media',
			'media-body',
			'media-body-outer',
			'media-object',
			'media-outer',
			'modal',
			'modal-header',
			'modal-body',
			'modal-footer',
			'nav',
			'nav-item',
			'popover',
			'progress',
			'progress-bar',
			'responsive',
			'row',
			'row-outer',
			'table-wrap',
			'tooltip',
		);

		foreach ( $shortcodes as $shortcode ) {

			$function = 'bs_' . str_replace( '-', '_', $shortcode );
			add_shortcode( $shortcode, array( $this, $function ) );

		}
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_button
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
            // 'block'
            // 'active'
            // 'disabled'
            // 'dropdown'
            // 'split'
            // 'outline'
			"type"			=> 'primary',
			"size"			=> false,
			"modal"         => false,
			"class"			=> false,
			"data"			=> false
		), $save_atts );

		if( isset($GLOBALS['button_count']) )
			$GLOBALS['button_count']++;
		else
			$GLOBALS['button_count'] = 0;

		$id = 'bs4-button-'. $GLOBALS['button_count'];
		$GLOBALS['dropdown_button'] = $id;

		$class	= array();
		$class[] = 'btn';
		$class[] = 'btn-' . ($this->is_flag('outline', $save_atts) ? 'outline-' : '') . $atts['type'];
		$class[] = ($atts['size'] && $atts['size'] != "md" )       ? 'btn-' . $atts['size'] : '';
		$class[] = ($this->is_flag('block', $save_atts))           ? 'btn-block' : '';
		$class[] = ($this->is_flag('active', $save_atts))          ? 'active' : '';
		$class[] = ($this->is_flag('disabled', $save_atts))        ? 'disabled' : '';
		$class[] = ($this->is_flag('dropdown', $save_atts))        ? 'dropdown-toggle' : '';
		$class[] = ($this->is_flag('split', $save_atts))           ? 'dropdown-toggle-split' : '';
		$class[] = ($atts['class'])                                ? $atts['class'] : '';

		$button_data   = array();
		$button_data[] = ($this->is_flag('dropdown', $save_atts)) ? 'toggle,dropdown' : '';
		if ($atts['modal']) {
    		$button_data[] = 'toggle,modal';
	    	$button_data[] = 'target,#' . $atts['modal'];
    	}
		$button_data   = implode( '|', array_filter($button_data) );

        $search_tags = array('a', 'button', 'input');

		$wrap_before = ($content && $this->testdom($content, $search_tags)) ? '' : '<button>';
		$wrap_after  = ($content && $this->testdom($content, $search_tags)) ? '' : '</button>';

		$content = do_shortcode( $wrap_before . $content . $wrap_after );
		$return = sprintf(
				'%s',
				$content
		);

		$return = $this->addclass( $search_tags, $return, $class );
		$return = $this->adddata( $search_tags, $return, $atts['data'] );
		$return = $this->adddata( $search_tags, $return, $button_data );
		if ($this->is_flag('dropdown', $save_atts)) {
			$return = $this->addattribute( $search_tags, $return, 'haspopup', 'true', 'aria-' );
			$return = $this->addattribute( $search_tags, $return, 'expanded', 'false', 'aria-' );
			$return = $this->addattribute( $search_tags, $return, 'id', $id, '' );
		}
		if ($this->is_flag('active', $save_atts)) {
			$return = $this->addattribute( $search_tags, $return, 'pressed', 'true', 'aria-' );
		}
		if ($this->is_flag('disabled', $save_atts)) {
			$return = $this->addattribute( $search_tags, $return, 'disabled', 'true', 'aria-' );
		}

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button_group
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_group_outer( $save_atts, $content = null ) {
        return $this->bs_button_group( $save_atts, $content );
	}
	function bs_button_group( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "vertical"  => false,
				// "justified" => false,
				"drop"      => false,
				"size"      => false,
				"class"     => false,
				"data"      => false
		), $save_atts );

        $class = array();
		$class[] = 'btn-group';
		$class[] = ( $atts['size'] && $atts['size'] != "md" )  ? 'btn-group-' . $atts['size'] : '';
		$class[] = ( $this->is_flag('vertical', $save_atts) )  ? 'btn-group-vertical' : '';
		$class[] = ( $this->is_flag('justified', $save_atts) ) ? 'btn-group-justified' : '';
		$class[] = ( $atts['drop']  )                          ? 'drop' . $atts['drop'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div role="group"%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button_toolbar
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_toolbar( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'btn-toolbar';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div role="toolbar"%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

 /*--------------------------------------------------------------------------------------
		*
		* bs_container
		*
		* @author Robin Wouters
		* @since 3.0.3.3
		*
		*-------------------------------------------------------------------------------------*/
	function bs_container( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "fluid"
				"class"  => false,
				"data"   => false
		), $save_atts );

        $class = array();
		$class[] = 'container' . ($this->is_flag('fluid', $save_atts) ? '-fluid' : '');

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}


	/*--------------------------------------------------------------------------------------
		 *
		 * bs_container_fluid
		 *
		 * @author Robin Wouters
		 * @since 3.0.3.3
		 *
		 *-------------------------------------------------------------------------------------*/
	function bs_container_fluid( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				 "class"  => false,
				 "data"   => false
		), $atts );

        $class = array();
		$class[] = 'container-fluid';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
		    '<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
		    $data_props,
		    do_shortcode( $content )
		);
	 }

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'dropdown';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div role="menu"%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown_item( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "disabled"
				"link"        => '#',
				"class"       => false,
				"data"        => false
		), $save_atts );

        $class = array();
		$class[] = 'dropdown-item';
		$class[] = ($this->is_flag('disabled', $save_atts)) ? 'disabled' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<a href="%s"%s%s>%s</a>',
			esc_url( $atts['link'] ),
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_divider
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown_divider( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"  => false
		), $atts );

        $class = array();
		$class[] = 'dropdown-divider';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_header
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown_header( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'dropdown-header';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/**
	 * Dropdown Menu shortcode
	 * @param  [type] $atts    shortcode attributes
	 * @param  string $content shortcode contents
	 * @return string
	 */
	function bs_dropdown_menu( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
			// "right"
			"class"			=> false,
			"data"			=> false,
		), $save_atts );

		$search_tags	= array('div');

		$class   = array();
		$class[] = 'dropdown-menu';
		$class[] = ($this->is_flag('right', $save_atts)) ? 'dropdown-menu-right' : '';

        $aria_labelledby = '';
		if (isset($GLOBALS['dropdown_button'])) {
            $aria_labelledby = ' aria-labelledby="' . $GLOBALS['dropdown_button'] . '"';
		    unset($GLOBALS['dropdown_button']);
		}

		$wrap_before = ($this->testdom($content, $search_tags)) ? '' : '<div' . $this->class_output ( $class, $atts["class"] ) . $aria_labelledby . '>';
		$wrap_after  = ($this->testdom($content, $search_tags)) ? '' : '</div>';

		$a_class   = array();
		$a_class[] = 'dropdown-item';
		$a_search_tags = array('a');

		$h_class   = array();
		$h_class[] = 'dropdown-header';
		$h_search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		$content = strip_tags($content, '<a><button><h1><h2><h3><h4><h5><h6><div>');
		$content = $wrap_before . $content . $wrap_after;
		//$content = $this->addclass( $search_tags, $content, $class );

		$return = sprintf(
				'%s',
				do_shortcode($content)
		);

		$return = $this->addclass( $h_search_tags, $return, $h_class );
		$return = $this->addclass( $a_search_tags, $return, $a_class );
		$return = $this->adddata( $search_tags, $return, $atts['data'] );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_nav
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
                // 'stacked'
                // 'tabs'
                // 'pills'
                // 'fill'
                // 'justified'
				"class"			=> false,
				"data"			=> false
			), $save_atts );

			$search_tags	= array('ul', 'nav');

			$wrap_before = ($this->testdom($content, $search_tags)) ? '' : '<ul>';
			$wrap_after  = ($this->testdom($content, $search_tags)) ? '' : '</ul>';

			$class   = array();
			$class[] = 'nav';
			$class[] = ($this->is_flag('stacked', $save_atts))  ? 'flex-column' : '';
			$class[] = ($this->is_flag('tabs', $save_atts))      ? 'nav-tabs' : '';
			$class[] = ($this->is_flag('pills', $save_atts))     ? 'nav-pills' : '';
			$class[] = ($this->is_flag('fill', $save_atts))      ? 'nav-fill' : '';
			$class[] = ($this->is_flag('justified', $save_atts)) ? 'nav-justified' : '';

			$content = do_shortcode( $wrap_before . $content . $wrap_after );

			$return = sprintf(
					'%s',
					$content
			);

			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );

			return $return;
		}

	/*--------------------------------------------------------------------------------------
		*
		* bs_nav_item
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav_item( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "active"
				// "disabled"
				// "dropdown"
				"link"     => '#',
				"class"    => false,
				"data"     => false,
		), $save_atts );

        $li_class = array();
		$li_class[]	= 'nav-item';
		$li_class[] = ( $this->is_flag('dropdown', $save_atts) ) ? 'dropdown' : '';


		$a_class = array();
		$a_class[] = 'nav-link';
		$a_class[] = ( $this->is_flag('dropdown', $save_atts) ) ? 'dropdown-toggle' : '';
		$a_class[] = ( $this->is_flag('active', $save_atts) )   ? 'active' : '';
		$a_class[] = ( $this->is_flag('disabled', $save_atts) ) ? 'disabled' : '';
		$a_aria = ( $this->is_flag('disabled', $save_atts) ) ? ' aria-disabled="true"' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

        //* If we have a dropdown shortcode inside the content we end the link before the dropdown shortcode, else all content goes inside the link
        $content = ( $this->is_flag('dropdown', $save_atts) ) ? str_replace( "<br />\n", '', $content ) : $content;
        $content = ( $this->is_flag('dropdown', $save_atts) ) ? str_replace( '[dropdown-menu]', '</a>[dropdown-menu]', $content ) : $content;

		return sprintf(
			'<li%1$s><a href="%2$s"%3$s%4$s%5$s%6$s>%7$s</a></li>',
			$this->class_output ( $li_class ),
			esc_url( $atts['link'] ),
			$this->class_output ( $a_class, $atts["class"] ),
			( $this->is_flag('dropdown', $save_atts) )   ? ' data-toggle="dropdown"' : '',
			$data_props,
			$a_aria,
			do_shortcode( $content )
		);

	}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_accordion
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_accordion( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false,
			), $save_atts );

			( isset($GLOBALS['accordion_count']) ) ? $GLOBALS['accordion_count']++ : $GLOBALS['accordion_count'] = 0;

			$GLOBALS['accordion'] = true;

			$class	= array();
			$class[] = "accordion";

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			$id = 'accordion' . $GLOBALS['accordion_count'];

			$return = sprintf(
					'<div id="%s"%s role="tablist"%s>%s</div>',
					$id,
        			$this->class_output ( $class, $atts["class"] ),
					$data_props,
					do_shortcode( $content )
			);

			unset($GLOBALS['accordion']);
			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * card
		 *
		 *-------------------------------------------------------------------------------------*/
	function bs_card_outer( $save_atts, $content = null ) {
	    return($this->bs_card( $save_atts, $content ));
	}
	function bs_card( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
                // show
				"class"	=> false,
				"data"	=> false
		), $save_atts );

		if (isset($GLOBALS['accordion'])) {
			if(!isset($GLOBALS['accordion_card'])) {
				$GLOBALS['accordion_card'] = 0;
			} else {
				$GLOBALS['accordion_card']++;
			}

			$GLOBALS['accordion_card_show'] = $this->is_flag('show', $save_atts);
        }

		$class = array();
		$class[] = 'card';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
				'<div%s%s>%s</div>',
    			$this->class_output ( $class, $atts["class"] ),
                $data_props,
				do_shortcode( $content )
        );
	}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_body
		 *
		 *-------------------------------------------------------------------------------------*/
	function bs_card_body_outer( $save_atts, $content = null ) {
	    return( $this->bs_card_body( $save_atts, $content ) );
	}
	function bs_card_body( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"	=> false,
				"data"	=> false
		), $save_atts );

		if (isset($GLOBALS['accordion'])) {
    		$show = ($GLOBALS['accordion_card_show']) ? ' show' : '';
	    }

		$wrap_before = (isset($GLOBALS['accordion'])) ? sprintf('<div id="collapse%s" class="collapse%s" data-parent="#accordion%s" aria-labelledby="bs-heading%s">', $GLOBALS['accordion_card'], $show, $GLOBALS['accordion_count'], $GLOBALS['accordion_card']) : '';
		$wrap_after = (isset($GLOBALS['accordion'])) ? '</div>' : '';

		$class = array();
		$class[] = 'card-body';

		$p_class = array();
		$p_class[] = 'card-text';
        $p_tags	   = array('p');

		$blockquote_class = array();
		$blockquote_class[] = 'card-blockquote';
		$blockquote_tags	= array('blockquote');

		$data_props = $this->parse_data_attributes( $atts['data'] );
		
		$return = sprintf(
				'<div%s%s>%s</div>',
       			$this->class_output ( $class, $atts["class"] ),
				$data_props,
				do_shortcode($content)
		);

        $return = $wrap_before . $return . $wrap_after;
		$return = $this->addclass( $p_tags, $return, $p_class );
		$return = $this->addclass( $blockquote_tags, $return, $blockquote_class );

		return $return;
	}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_title
		 *
		 *-------------------------------------------------------------------------------------*/

	function bs_card_title( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"   => false
		), $atts );

		$search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		$wrap_before = ( $this->testdom($content, $search_tags) ) ? '' : '<h4>';
		$wrap_after  = ( $this->testdom($content, $search_tags) ) ? '' : '</h4>';

		$class	= array();
		$class[]  = 'card-title';

		$return = sprintf(
				'%s',
				do_shortcode( $wrap_before . $content . $wrap_after )
		);

		$return = $this->addclass( $search_tags, $return, $class );
		$return = $this->adddata( $search_tags, $return, $atts['data'] );

		return $return;
	}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_subtitle
		 *
		 *-------------------------------------------------------------------------------------*/
	function bs_card_subtitle( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"   => false
		), $atts );

		$search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		$wrap_before = ($this->testdom($content, $search_tags)) ? '' : '<h6>';
		$wrap_after = ($this->testdom($content, $search_tags)) ? '' : '</h6>';

		$class	= array();
		$class[]  = 'card-subtitle';

		$return = sprintf(
				'%s',
				do_shortcode( $wrap_before . $content . $wrap_after )
		);

		$return = $this->addclass( $search_tags, $return, $class );
		$return = $this->adddata( $search_tags, $return, $atts['data'] );

		return $return;
	}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_img
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_img( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
                    // "top"
                    // "bottom"
					"class" => false,
					"data"   => false
			), $save_atts );

			$class	= array();
			if ($this->is_flag('top', $save_atts)) {
			    $class[] = 'card-img-top';
			} else if ($this->is_flag('bottom', $save_atts)) {
			    $class[] = 'card-img-bottom';
			} else {
    			$class[] = 'card-img';
			}

            $search_tags = array('img');

			$content = do_shortcode( $content );
			$content = strip_tags($content, '<img><a>');

			$return = sprintf(
					'%s',
					$content
			);

			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );

			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_img_overlay
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_img_overlay( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class"	=> false,
					"data"	=> false
			), $atts );

			$class = array();
			$class[] = 'card-img-overlay';

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			return sprintf(
					'<div%s%s>%s</div>',
           			$this->class_output ( $class, $atts["class"] ),
					$data_props,
					do_shortcode( $content )
			);
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_header
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_header( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false
			), $atts );

			$search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div');

			$wrap_before = '';
			$wrap_after = '';

            $id = (isset($GLOBALS['accordion'])) ? ' id="bs-heading' . $GLOBALS['accordion_card'] . '"' : '';
  			$wrap_before .= ($this->testdom($content, $search_tags)) ? '' : '<div' . $id . '>';
    		$wrap_after .= ($this->testdom($content, $search_tags)) ? '' : '</div>';

   			$wrap_before .= (isset($GLOBALS['accordion'])) ? sprintf('<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse%1$s" aria-controls="collapse%1$s" aria-expanded="%2$s">', $GLOBALS['accordion_card'], $GLOBALS['accordion_card_show'] ? 'true' : 'false') : '';
    		$wrap_after .= (isset($GLOBALS['accordion'])) ? '</button>' : '';

			$class = array();
			$class[] = 'card-header';
            $class = array_merge($class, explode(' ', $atts['class']));

			$return = sprintf(
					'%s',
					do_shortcode( $content )
			);

            $return = $wrap_before . $return . $wrap_after;
			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );

			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_footer
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_footer( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false
			), $atts );

			$search_tags = array('div');

			$wrap_before = ($this->testdom($content, $search_tags)) ? '' : '<div>';
			$wrap_after = ($this->testdom($content, $search_tags)) ? '' : '</div>';

			$class = array();
			$class[] = 'card-footer';

			$return = sprintf(
					'%s',
					do_shortcode( $wrap_before . $content . $wrap_after )
			);

			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );

			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_group
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_group( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false
			), $atts );

			$class = array();
			$class[] = 'card-group';

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			$return = sprintf(
					'<div%s%s>%s</div>',
           			$this->class_output ( $class, $atts["class"] ),
					$data_props,
					do_shortcode($content)
			);

			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_deck
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_deck( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false
			), $atts );

			$class = array();
			$class[] = 'card-deck';

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			$return = sprintf(
					'<div%s%s>%s</div>',
           			$this->class_output ( $class, $atts["class"] ),
					$data_props,
					do_shortcode($content)
			);

			return $return;
		}

    	/*--------------------------------------------------------------------------------------
		 *
		 * bs_card_columns
		 *
		 *-------------------------------------------------------------------------------------*/
		function bs_card_columns( $atts, $content = null ) {
            $atts = array_change_key_case( (array) $atts, CASE_LOWER );
			$atts = shortcode_atts( array(
					"class" => false,
					"data"   => false
			), $atts );

			$class = array();
			$class[] = 'card-columns';

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			$return =sprintf(
					'<div%s%s>%s</div>',
           			$this->class_output ( $class, $atts["class"] ),
					$data_props,
					do_shortcode($content)
			);

			return $return;
		}


	/*--------------------------------------------------------------------------------------
		*
		* bs_alert
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_alert( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "dismissable"
				// "fade"
				"type"          => false,
				"class"         => false,
				"data"          => false
		), $save_atts );

		$class = array();
		$class[] = 'alert';
		$class[] = ( $atts['type'] )                             ? 'alert-' . $atts['type'] : 'alert-primary';
		$class[] = ( $this->is_flag('dismissable', $save_atts) ) ? 'alert-dismissable' : '';
		$class[] = ( $this->is_flag('fade', $save_atts) )        ? 'fade' : '';
		$class[] = ( $this->is_flag('fade', $save_atts) )        ? 'show' : '';

		$dismissable = ( $this->is_flag('dismissable', $save_atts) ) ? $this->close_icon("alert") : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div role="alert"%s%s>%s%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$dismissable,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_progress
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_progress( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"     => false,
				"data"      => false
		), $save_atts );

		$class = array();
		$class[] = 'progress';


		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_progress_bar
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_progress_bar( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "striped"
				// "animated"
				// "label"
				"type"      => false,
				"percent"   => false,
				"class"     => false,
				"data"      => false
		), $save_atts );

		$class = array();
		$class[] = 'progress-bar';
		$class[] = ( $atts['type'] ) ? 'bg-' . $atts['type'] : '';
		$class[] = ( $this->is_flag('striped', $save_atts) )  ? 'progress-bar-striped' : '';
		$class[] = ( $this->is_flag('animated', $save_atts) ) ? 'progress-bar-animated' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s role="progressbar" %s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			( $atts['percent'] ) ? ' style="width: ' . (int) $atts['percent'] . '%;"' : '',
			$data_props,
			( $atts['percent'] ) ? sprintf('<span%s>%s</span>', ( !$this->is_flag('label', $save_atts) ) ? ' class="sr-only"' : '', (int) $atts['percent'] . '%') : ''
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_code
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_code( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
					// "inline"
					// "scrollable"
					"class"       => false,
					"data"        => false
		), $save_atts );

		$class = array();
		$class[] = ( $this->is_flag('scrollable', $save_atts) ) ? 'pre-scrollable' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s%2$s%3$s>%4$s</%1$s>',
			( $this->is_flag('inline', $save_atts) ) ? 'code' : 'pre',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$content
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_row
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_row_outer( $atts, $content = null ) {
	    return($this->bs_row( $atts, $content ));
	}
	function bs_row( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'row';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_column
		*
		* @author Simon Yeldon
		* @since 1.0
		*-------------------------------------------------------------------------------------*/
	function bs_column_outer( $atts, $content = null ) {
	    return($this->bs_column( $atts, $content ));
	}
	function bs_column( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"xl"          => false,
				"lg"          => false,
				"md"          => false,
				"sm"          => false,
				"xs"          => false,
				"offset-xl"   => false,
				"offset-lg"   => false,
				"offset-md"   => false,
				"offset-sm"   => false,
				"offset-xs"   => false,
				"class"       => false,
				"data"        => false
		), $atts );

		$class = array();
		$class[] = '';
		$class[] = ( $atts['xl'] )			                            ? 'col-xl-' . $atts['xl'] : '';
		$class[] = ( $atts['lg'] )			                            ? 'col-lg-' . $atts['lg'] : '';
		$class[] = ( $atts['md'] )                                      ? 'col-md-' . $atts['md'] : '';
		$class[] = ( $atts['sm'] )                                      ? 'col-sm-' . $atts['sm'] : '';
		$class[] = ( $atts['xs'] )                                      ? 'col-' . $atts['xs'] : '';
		$class[] = ( $atts['offset-xl'] || $atts['offset-xl'] === "0" ) ? 'offset-xl-' . $atts['offset-xl'] : '';
		$class[] = ( $atts['offset-lg'] || $atts['offset-lg'] === "0" ) ? 'offset-lg-' . $atts['offset-lg'] : '';
		$class[] = ( $atts['offset-md'] || $atts['offset-md'] === "0" ) ? 'offset-md-' . $atts['offset-md'] : '';
		$class[] = ( $atts['offset-sm'] || $atts['offset-sm'] === "0" ) ? 'offset-sm-' . $atts['offset-sm'] : '';
		$class[] = ( $atts['offset-xs'] || $atts['offset-xs'] === "0" ) ? 'offset-' . $atts['offset-xs'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_flex
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*-------------------------------------------------------------------------------------*/
	function bs_flex( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "inline"
				"direction"             => false,
				"justify"               => false,
				"align-items"           => false,
				"align-content"         => false,
				"wrap"                  => false,
				"class"                 => false,
				"data"                  => false
		), $save_atts );

		$class = array();
		$class[] .= 'd' . ( $this->is_flag('inline', $save_atts)     ? '-inline' : '' ) . '-flex';
        $class[] .= ( $atts['direction'] )                           ? 'flex-' . $atts['direction'] : '';
        $class[] .= ( $atts['justify'] )                             ? 'justify-content-' . $atts['justify'] : '';
        $class[] .= ( $atts['align-content'] )                       ? 'align-content-' . $atts['align-content'] : '';
        $class[] .= ( $atts['align-items'] )                         ? 'align-items-' . $atts['align-items'] : '';
        $class[] .= ( $atts['wrap'] ) ? ( $atts['wrap'] == "reverse" ? 'flex-wrap-reverse' : 'flex-wrap' ) : 'flex-nowrap';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_flex_item
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*-------------------------------------------------------------------------------------*/
	function bs_flex_item( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"align"               => false,
				// "fill"
				// "grow"                => false,
				// "no-grow"             => false,
				// "shrink"              => false,
				// "no-shrink"           => false,
				"class"               => false,
				"data"                => false
		), $save_atts );

		$class = array();
        $class[] = ( $atts['align'] )                          ? 'align-self-' . $atts['align'] : '';
        $class[] = ( $this->is_flag('fill', $save_atts) )      ? 'flex-fill' : '';
        $class[] = ( $this->is_flag('grow', $save_atts) )      ? 'flex-grow-1' : '';
        $class[] = ( $this->is_flag('no-grow', $save_atts) )   ? 'flex-grow-0' : '';
        $class[] = ( $this->is_flag('shrink', $save_atts) )    ? 'flex-shrink-1' : '';
        $class[] = ( $this->is_flag('no-shrink', $save_atts) ) ? 'flex-shrink-0' : '';


		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

		/**
		 * List Group shortcode
		 * @param  [type] $atts    shortcode attributes
		 * @param  string $content shortcode contents
		 * @return string
		 */
		function bs_list_group( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
		        // "flush"
		        // "media"
                // "linked"
				"class"			=> false,
				"data"			=> false
			), $save_atts );

			$search_tags	= array('ul', 'div');
			$wrap_before = ($this->testdom($content, $search_tags)) ? '' : ($this->is_flag('linked', $save_atts)) ? '<div>'  : '<ul>';
			$wrap_after  = ($this->testdom($content, $search_tags)) ? '' : ($this->is_flag('linked', $save_atts)) ? '</div>' : '</ul>';

			$class   = array();
			$class[] = 'list-group';
			$class[] = ($this->is_flag('flush', $save_atts)) ? 'list-group-flush' : '';
			$class[] = ($this->is_flag('media', $save_atts)) ? 'list-unstyled' : '';

			$li_class	= array();
			$li_class[]	= ($this->is_flag('media', $save_atts)) ? 'media' : 'list-group-item';
			$li_search_tags	= array('li');

			$a_class	= array();
			$a_class[]	= 'list-group-item';
			$a_class[]	= 'list-group-item-action';
			$a_search_tags	= array('a');

			$content = do_shortcode( $wrap_before . $content . $wrap_after );

			$return = sprintf(
					'%s',
					$content
			);

			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->addclass( $li_search_tags, $return, $li_class );
			$return = $this->addclass( $a_search_tags, $return, $a_class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );
			$return = $this->striptagfromdom( 'br', $return );

			return $return;
		}


		/**
		 * List Group type shortcode
		 * @param  [type] $atts    shortcode attributes
		 * @param  string $content shortcode contents
		 * @return string
		 */
		function bs_list_group_item( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
                // "active"
                // "disabled"
				"type"			=> false,
				"class"			=> false,
				"data"			=> false
			), $save_atts );

			$search_tags = array('a', 'button', 'li');

			$class   = array();
			$class[] = 'list-group-item';
			$class[] = ( $atts['type'] ) ? 'list-group-item-' . $atts['type'] : '';
    		$class[] = ($this->is_flag('active', $save_atts))   ? 'active' : '';
    		$class[] = ($this->is_flag('disabled', $save_atts)) ? 'disabled ' : '';

			$content = do_shortcode( $content );

			$return = sprintf(
					'%s%s%s',
                    ($this->testdom($content, $search_tags)) ? '' : '<li>',
					$content,
                    ($this->testdom($content, $search_tags)) ? '' : '</li>'
			);

			$return = $this->addclass( $search_tags, $return, $class );
			$return = $this->adddata( $search_tags, $return, $atts['data'] );
			$return = $this->striptagfromdom( 'br', $return );

			return $return;
    }


	/*--------------------------------------------------------------------------------------
		*
		* bs_breadcrumb
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_breadcrumb( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'breadcrumb';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<ul%s%s>%s</ul>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_breadcrumb_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_breadcrumb_item( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "active"
				"link" => '#',
				"class"  => false,
				"data" => false
		), $save_atts );

		$class = array();

        $li_class = array();
		$li_class[] = 'breadcrumb-item';
		$li_class[] = ($this->is_flag('active', $save_atts)) ? 'active' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

        $content = do_shortcode( $content );

		$link = sprintf(
			'<a href="%s"%s%s>%s</a>',
			esc_url( $atts['link'] ),
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$content
		);

		return sprintf(
			'<li%s>%s</li>',
			$this->class_output ( $li_class ),
		    ( $this->is_flag('active', $save_atts) ) ? $content : $link
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_badge
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_badge( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "right"
				"class"   => false,
				"data"    => false
		), $save_atts );

		$class = array();
		$class[] = 'badge';
		$class[] = ( $this->is_flag('right', $save_atts) ) ? 'float-right' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span%s%s>%s</span>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_icon (Font Awesome)
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_icon( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"prefix" => false,
				"type"   => false,
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = ( $atts['prefix'] )   ? $atts['prefix'] : 'fas';
		$class[] = ( $atts['type'] )     ? 'fa-' . $atts['type'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<i%s%s>%s</i>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_icon_stack (Font Awesome)
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_icon_stack( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'fa-stack';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span%s%s>%s</span>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_table_wrap
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_table_wrap( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "bordered"
				// "striped"
				// "hover"
				// "condensed"
				// "responsive"
				"class"      => false,
				"data"       => false
		), $save_atts );

		$class   = array();
		$class[] = 'table';
        $class[] = $this->is_flag('bordered', $save_atts)  ?  'table-bordered' : '';
        $class[] = $this->is_flag('striped', $save_atts)   ?  'table-striped' : '';
        $class[] = $this->is_flag('hover', $save_atts)     ?  'table-hover' : '';
        $class[] = $this->is_flag('condensed', $save_atts) ?  'table-sm' : '';
		$class[] = ( $atts['class'] )                      ?   $atts['class'] : '';

		$tag = array('table');

		$return = do_shortcode($content);

		$return = ( $this->is_flag('responsive', $save_atts) ) ? '<div class="table-responsive">' . $return . '</div>' : $return;

		$return = $this->addclass( $tag, $return, $class );
		$return = $this->adddata( $tag, $return, $atts['data'] );

		return $return;
	}



		/**
		 * Carousel shortcode
		 * @param  [type] $atts    shortcode attributes
		 * @param  string $content shortcode contents
		 * @return string
		 */
		function bs_carousel( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
			    // "controls"
			    // "indicators"
			    // "fade"
				"interval" => false,
				"pause"    => 'hover',
				"wrap"     => 'true',
				"class"    => false,
				"data"     => false
			), $save_atts );

			if( isset($GLOBALS['carousel_count']) )
				$GLOBALS['carousel_count']++;
			else
				$GLOBALS['carousel_count'] = 0;

			$id = 'bs4-carousel-'. $GLOBALS['carousel_count'];

			$class   = array();
			$class[] = 'carousel';
			$class[] = 'slide';
			$class[] = ( $this->is_flag( 'fade', $save_atts ) ) ? 'carousel-fade' : '';

			$item_class	= array();
			//$item_class[]  = 'carousel-item';
			//$item_class[]  = 'img-fluid';

			$active_class	= array();
			$active_class[]  = 'active';

			$caption_class = array();
			$caption_class[] = 'carousel-caption';

			$item_tags = array('figure', 'img');
			$fallback_tag = 'div';

			$indicator_tags = array('li');

			$caption_tags = array('figcaption');

			$content = do_shortcode( $content );

            $controls = '';
            $controls .= '<a class="carousel-control-prev" href="' . esc_url( '#' . $id ) . '" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>';
            $controls .= '<a class="carousel-control-next" href="' . esc_url( '#' . $id ) . '" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>';

			$indicators = array();
			$i = 0;
            $cnt = $this->counttags('carousel-item', $content);
			while( $i < $cnt ) {
				$indicators[] = sprintf(
					'<li data-target="%s" data-slide-to="%s"></li>',
					esc_attr( '#' . $id ),
					esc_attr( $i )
				);
				$i++;
			}

			// Remove wrapped image alignment and caption classes
			$content = preg_replace('/alignnone/', '', $content);
			$content = preg_replace('/alignright/', '', $content);
			$content = preg_replace('/alignleft/', '', $content);
			$content = preg_replace('/aligncenter/', '', $content);
			$content = preg_replace('/wp-caption/', '', $content);

    		$data_props = $this->parse_data_attributes( $atts['data'] );

			$return = sprintf(
							'<div%s id="%s" data-ride="carousel"%s%s%s%s>%s<div class="carousel-inner" role="listbox">%s</div>%s</div>',
							$this->class_output($class, $atts['class']),
							esc_attr( $id ),
							( $atts['interval'] )   ? sprintf( ' data-interval="%d"', $atts['interval'] ) : '',
							( $atts['pause'] )      ? sprintf( ' data-pause="%s"', esc_attr( $atts['pause'] ) ) : '',
							( $atts['wrap'] ) ? sprintf( ' data-wrap="%s"', esc_attr( $atts['wrap'] ) ) : '',
							$data_props,
							( $this->is_flag( 'indicators', $save_atts ) ) ? '<ol class="carousel-indicators">' . implode( $indicators ) . '</ol>' : '',
                            $content,
                            ( $this->is_flag( 'controls', $save_atts ) ) ? $controls : ''
			);

			$return = $this->addclass( $item_tags, $return, $item_class );
			$return = $this->addclass( $item_tags, $return, $active_class, '1' );
			$return = $this->addclass( $indicator_tags, $return, $active_class, '1' );
			$return = $this->addclass( $caption_tags, $return, $caption_class);

			return $return;
		}

	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel_item
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel_item( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
		        // "active"
				"class"   => false,
				"data"    => false
		), $save_atts );

		$class   = array();
		$class[] = 'carousel-item';
		$class[] = ( $this->is_flag( 'active', $save_atts ) ) ? 'active' : '';


		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel_caption
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel_caption( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $save_atts );

		$class   = array();
		$class[] = 'carousel-caption';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

		/**
		 * Tooltip shortcode
		 */
		function bs_tooltip( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
			        // "animation"
			        // "html"
					"placement" => "top",
					"title"     => false,
					"data"      => false,
			), $save_atts );

			$tooltip_data = array();
			$tooltip_data[] = "toggle,tooltip";
			$tooltip_data[] = "placement," . $atts['placement'];
			$tooltip_data[]	= ($this->is_flag('html', $save_atts)) ? 'html,true' : '';
			$tooltip_data[]	= ($this->is_flag('animation', $save_atts)) ? 'animation,true' : '';
			$tooltip_data = implode( '|', array_filter($tooltip_data) );

			$return = sprintf(
					'%s',
					do_shortcode($content)
			);

			$return = $this->addattribute( false, $return, 'title', $atts['title'] );
			$return = $this->adddata( false, $return, $atts['data'] );
			$return = $this->adddata( false, $return, $tooltip_data );

			return $return;
		}

		/**
		 * Popover shortcode
		 */
		function bs_popover( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
                    // "html"
                    // "animation"
					"container" => "body",
					"placement" => "top",
					"trigger" => "",
					"title" => false,
					"content" => false,
					"data"   => false,
			), $save_atts );

			$popover_data = array();
			$popover_data[] = "toggle,popover";
			$popover_data[] = "placement," . $atts['placement'];
			$popover_data[] = "container," . $atts['container'];
			$popover_data[] = "content," . $atts['content'];
			$popover_data[] = "trigger," . $atts['trigger'];
			$popover_data[]	= ($this->is_flag('html', $save_atts)) ? 'html,true' : '';
			$popover_data[]	= ($this->is_flag('animation', $save_atts)) ? 'animation,true' : '';
			$popover_data = implode( '|', array_filter($popover_data) );

			$return = sprintf(
					'%s',
					do_shortcode($content)
			);

			$return = $this->addattribute( false, $return, 'title', $atts['title'] );
			$return = $this->adddata( false, $return, $atts['data'] );
			$return = $this->adddata( false, $return, $popover_data );

			return $return;
		}


	/*--------------------------------------------------------------------------------------
		*
		* bs_media
		*
		* @author
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_media_outer( $save_atts, $content = null ) {
	    return($this->bs_media( $save_atts, $content ));
	}
	function bs_media( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
                // "list-group"
   				"class"  => false,
				"data"   => false
		), $save_atts );

        $div = ($this->is_flag('list-group', $save_atts)) ? 'li' : 'div';

		$class = array();
		$class[] = 'media';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%s%s%s>%s</%s>',
			$div,
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content ),
			$div
		);
	}

    function bs_media_object( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"align" => false,
				"class" => false,
				"data"  => false
		), $atts );

		$class   = array();
		$class[] = $atts['class'];
		$class[] = ( $atts['align'] ) ? 'align-self-' . $atts['align'] : '';
		$class[] = ( $atts['class'] ) ? $atts['class'] : '';

		$return = '';

		$tag = array('figure', 'div', 'img', 'i', 'span');
		$return = do_shortcode($content);
		$return = $this->striptagfromdom( 'br', $return );
		$return = $this->addclass( $tag, $return, $class );
		$return = $this->adddata( $tag, $return, $atts['data'] );

		return $return;
	}

	function bs_media_body_outer( $save_atts, $content = null ) {
	    return($this->bs_media_body( $save_atts, $content ));
	}
	function bs_media_body( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $div_class = array();
		$div_class[] = 'media-body';

		$h_class   = array();
        $h_class[] = 'mt-0';
		$h_search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return = sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $div_class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);

		$return = $this->addclass( $h_search_tags, $return, $h_class );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_jumbotron
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_jumbotron( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
					// "fluid"
					"class"  => false,
					"data"   => false
		), $save_atts );

		$class = array();
		$class[] = 'jumbotron';
		$class[] = ($this->is_flag('fluid', $save_atts)) ? 'jumbotron-fluid' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s%s%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			($this->is_flag('fluid', $save_atts)) ? '<div class="container">' : '',
			do_shortcode( $content ),
			($this->is_flag('fluid', $save_atts)) ? '</div>' : ''
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_lead
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_lead( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'lead';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return = sprintf(
				'%s',
   				do_shortcode( $content )
		);

		$return = $this->addclass( null, $return, $class );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_html
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_html( $atts, $content = null ) {

        $content = str_replace("&#8221;", '"', $content);
        $content = str_replace("&#8217;", '"', $content);
        $content = str_replace("&#8243;", '"', $content);
		$content =  wp_specialchars_decode($content, ENT_QUOTES);
		return ($content);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_lorem_ipsum
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_lorem_ipsum( $atts, $content = null ) {
	    require_once( dirname( __FILE__ ) . '/includes/LoremIpsum.php' );

        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"tag"         => 'p',
				"words"       => false,
				"sentences"   => false,
				"paragraphs"  => false,
				"class"       => false,
				"data"        => false
		), $atts );

	    $lipsum = new joshtronic\LoremIpsum();

        if ($atts['words'] && intval($atts['words']) > 0) {
            $return = $lipsum->words(intval($atts['words']), $atts['tag']);
        } else if ($atts['sentences'] && intval($atts['sentences'], ) > 0) {
            $return = $lipsum->sentences(intval($atts['sentences']), $atts['tag']);
        } else if ($atts['paragraphs'] && intval($atts['paragraphs']) > 0) {
            $return = $lipsum->paragraph(intval($atts['paragraphs']), $atts['tag']);
        } else {
            $return = $lipsum->sentences(1, $atts['tag']);
        }

		$return = $this->addclass( array($atts['tag']), $return, explode(' ', $atts['class']));
		$return = $this->adddata( array($atts['tag']), $return, $atts['data'] );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_img
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_img( $save_atts, $content = null ) {
        $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				// "responsive"
				// "thumbnail"
				"class"      => false,
				"data"       => false
		), $save_atts );

		$class   = array();
   		$class[] = ( $this->is_flag('responsive', $save_atts) ) ? 'img-fluid' : '';
   		$class[] = ( $this->is_flag('thumbnail', $save_atts) )  ? 'img-thumbnail' : '';
		$class[] = ( $atts['class'] )                           ? $atts['class'] : '';

		$return = '';
		$tag = array('img');
		$return = do_shortcode($content);
		$return = $this->addclass( $tag, $return, $class );
		$return = $this->adddata( $tag, $return, $atts['data'] );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
     * bs_img_gen
     *
     * Based on:
     * Dynamic Dummy Image Generator — as seen on DummyImage.com by Fabian Beiner
     *
     * (Original idea by Russel Heimlich. When I first published this script,
     * DummyImage.com was not Open Source, so I had to write a small script to
     * replace the function on my own server.)
     *
	 *-------------------------------------------------------------------------------------*/
	function bs_img_gen( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"size"          => false,
				"file"          => false,
				"text"          => false,
				"bg"            => false,
				"color"         => false,
				"alt"           => false,
				"class"         => false,
				"data"          => false
		), $atts );

        /**
         * Handle the “size” parameter.
         */
        $size = '640x480';
        if (isset($atts['size'])) {
            $size = $atts['size'];
        }
        list($imgWidth, $imgHeight) = explode('x', $size . 'x');
        if ($imgHeight === '') {
            $imgHeight = $imgWidth;
        }
        $filterOptions = [
            'options' => [
                'min_range' => 0,
                'max_range' => 9999
            ]
        ];
        if (filter_var($imgWidth, FILTER_VALIDATE_INT, $filterOptions) === false) {
            $imgWidth = '640';
        }
        if (filter_var($imgHeight, FILTER_VALIDATE_INT, $filterOptions) === false) {
            $imgHeight = '480';
        }

        /**
         * Handle the “file” parameter.
         */
        $filetype = 'png';
        if (isset($atts['file']) && in_array(strtolower($atts['file']), ['png', 'gif', 'jpg', 'jpeg'])) {
            $filetype = strtolower($atts['file']);
        }

        /**
         * Handle the “text” parameter.
         */
        $text = $imgWidth . '×' . $imgHeight;
        if (isset($atts['text']) && strlen($atts['text'])) {
            $text = filter_var(trim($atts['text']), FILTER_SANITIZE_STRING);
        }
        $encoding = mb_detect_encoding($text, 'UTF-8, ISO-8859-1');
        if ($encoding !== 'UTF-8') {
            $text = mb_convert_encoding($text, 'UTF-8', $encoding);
        }
        $text = mb_encode_numericentity($text,
                                        [0x0, 0xffff, 0, 0xffff],
                                        'UTF-8');

        /**
         * Handle the “bg” parameter.
         */
        $bg = '000080';
        if (isset($atts['bg']) && (strlen($atts['bg']) === 6 || strlen($atts['bg']) === 3)) {
            $bg = strtoupper($atts['bg']);
            if (strlen($atts['bg']) === 3) {
                $bg =
                    strtoupper($atts['bg'][0] .
                               $atts['bg'][0] .
                               $atts['bg'][1] .
                               $atts['bg'][1] .
                               $atts['bg'][2] .
                               $atts['bg'][2]);
            }
        }
        list($bgRed, $bgGreen, $bgBlue) = sscanf($bg, "%02x%02x%02x");

        /**
         * Handle the “color” parameter.
         */
        $color = 'FFFFFF';
        if (isset($atts['color']) && (strlen($atts['color']) === 6 || strlen($atts['color']) === 3)) {
            $color = strtoupper($atts['color']);
            if (strlen($atts['color']) === 3) {
                $color =
                    strtoupper($atts['color'][0] .
                               $atts['color'][0] .
                               $atts['color'][1] .
                               $atts['color'][1] .
                               $atts['color'][2] .
                               $atts['color'][2]);
            }
        }
        list($colorRed, $colorGreen, $colorBlue) = sscanf($color, "%02x%02x%02x");

        /**
         * Handle the "alt" parameter.
         */
		if (! isset($GLOBALS['img_gen_count']) ) $GLOBALS['img_gen_count'] = 0;
        $alt_text = ($atts['alt']) ? ($atts['alt']) : "Generated Dummy Image " . ++$GLOBALS['img_gen_count'];


        /**
         * Define the typeface settings.
         */
        $fontFile = plugin_dir_path( __FILE__ ) . '/includes/fonts/RobotoMono-Regular.ttf';
        if ( ! is_readable($fontFile)) {
            $fontFile = 'arial';
        }

        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }

        /**
         * Generate the image.
         */
        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, $colorRed, $colorGreen, $colorBlue);
        $bgFill    = imagecolorallocate($image, $bgRed, $bgGreen, $bgBlue);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);

        while ($textBox[4] >= $imgWidth) {
            $fontSize -= round($fontSize / 2);
            $textBox  = imagettfbbox($fontSize, 0, $fontFile, $text);
            if ($fontSize <= 9) {
                $fontSize = 9;
                break;
            }
        }
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);

        /**
         * Return the image and destroy it afterwards.
         */
        ob_start();
        switch ($filetype) {
            case 'png':
                $img_type = 'image/png';
                imagepng($image, null, 9);
                break;
            case 'gif':
                $img_type = 'image/gif';
                imagegif($image);
                break;
            case 'jpg':
            case 'jpeg':
                $img_type = 'image/jpeg';
                imagejpeg($image);
                break;
        }
        imagedestroy($image);
        $img_data = ob_get_clean();

		$data_props = $this->parse_data_attributes( $atts['data'] );
		$class = [];

		return sprintf(
			'<img%s%s src="data:%s;base64,%s" alt="%s" />',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$img_type,
			base64_encode( $img_data ),
			$alt_text

		);
    }

	/*--------------------------------------------------------------------------------------
		*
		* bs_blockquote
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_blockquote( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
					"class"  => false,
					"data"   => false
		), $atts );

		$class = array();
		$class[] = 'blockquote';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<blockquote%s%s>%s</blockquote>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_blockquote_footer
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_blockquote_footer( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
					"class"  => false,
					"data"   => false
		), $atts );

		$class = array();
		$class[] = 'blockquote-footer';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<footer%s%s>%s</footer>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_embed_responsive
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_embed_responsive( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"ratio"      => false,
				"class"      => false,
				"data"       => false
		), $atts );

		$class = array();
		$class[] = 'embed-responsive';
		$class[] = ( $atts['ratio'] ) ? 'embed-responsive-' . $atts['ratio'] : '';

		$embed_class = array();
		$embed_class[] = 'embed-responsive-item';

		$tag = array('iframe', 'embed', 'video', 'object');
		$content = do_shortcode($content);
		$content = $this->addclass( $tag, $content, $embed_class );

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$content
		);
	}


		/*--------------------------------------------------------------------------------------
		*
		* bs_responsive
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_responsive( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"hidden"  => false,
				"block"  => false,
				"inline"  => false,
				"inline_block"  => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		if( $atts['hidden'] ) {
			$hidden = explode( ' ', $atts['hidden'] );
			foreach( $hidden as $h ):
				$class[] = ( $h == "xs" ? "d-none" : "d-$h-none" );
			endforeach;
		}
		if( $atts['block'] ) {
			$block = explode( ' ', $atts['block'] );
			foreach( $block as $b ):
				$class[] = ( $b == "xs" ? "d-block" : "d-$b-block" );
			endforeach;
		}
		if( $atts['inline'] ) {
			$inline = explode( ' ', $atts['inline'] );
			foreach( $inline as $i ):
				$class[] = ( $i == "xs" ? "d-inline" : "d-$i-inline" );
			endforeach;
		}
		if( $atts['inline_block'] ) {
			$inline_block = explode( ' ', $atts['inline_block'] );
			foreach( $inline_block as $ib ):
				$class[] = ( $ib == "xs" ? "d-inline-block" : "d-$ib-inline-block" );
			endforeach;
		}

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

		/**
		 * Modal shortcode
		 * @param  [type] $atts    shortcode attributes
		 * @param  string $content shortcode contents
		 * @return string
		 */
		function bs_modal( $save_atts, $content = null ) {
            $save_atts = array_change_key_case( (array) $save_atts, CASE_LOWER );
			$atts = shortcode_atts( array(
                // "fade"
                // "centered"
                // "scrollable"
				"size"			=> false,
				"backdrop"      => 'true',
                "id"			=> false,
                "class"			=> false,
				"data"			=> false
			), $save_atts );

      ( isset($GLOBALS['modal_count']) ) ? $GLOBALS['modal_count']++ : $GLOBALS['modal_count'] = 0;

      $id = ($atts['id'] != false) ? $atts['id'] : 'modal-' . $GLOBALS['modal_count'];

      $class   = array();
      $class[] = 'modal';
      $class[] = ($this->is_flag('fade', $save_atts)) ? 'fade' : '';

      $dialog_class   = array();
      $dialog_class[] = 'modal-dialog';
	  $dialog_class[] = ($atts['size']) ? 'modal-' . $atts['size'] : '';
      $dialog_class[] = ($this->is_flag('centered', $save_atts)) ? 'modal-dialog-centered' : '';
      $dialog_class[] = ($this->is_flag('scrollable', $save_atts)) ? 'modal-dialog-scrollable' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

			$content = do_shortcode( $content );

			$return = sprintf(
          '<div id="%s"%s data-backdrop="%s" aria-labelledby="%s" aria-hidden="true" tabindex="-1" role="dialog" %s>
            <div%s role="document">
              <div class="modal-content">
                %s
              </div>
            </div>
          </div>',
          $id,
          $this->class_output($class, $atts['class']),
          $atts['backdrop'],
          $id,
          $data_props,
					$this->class_output($dialog_class),
					do_shortcode($content)
			);

			return $return;
    }


	/**
	 * Modal header shortcode
	 * @param  [type] $atts    shortcode attributes
	 * @param  string $content shortcode contents
	 * @return string
	 */
	function bs_modal_header( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"   => false
		), $atts );

		$search_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		$wrap_before = ($this->testdom($content, $search_tags)) ? '' : '<h5>';
		$wrap_after = ($this->testdom($content, $search_tags)) ? '' : '</h5>';

		$class	 = array();
        $class[] = 'modal-header';

        $h_class   = array();
        $h_class[] = "modal-title";

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$content = do_shortcode( $wrap_before . $content . $wrap_after );

		$return = sprintf(
        '<div%s%s>
          %s
          %s
        </div>',
        $this->class_output($class, $atts['class']),
        $data_props,
				$content,
				$this->close_icon("modal")
		);

    $return = $this->addclass( $search_tags, $return, $h_class );

		return $return;
  }



	/**
	 * Modal body shortcode
	 * @param  [type] $atts    shortcode attributes
	 * @param  string $content shortcode contents
	 * @return string
	 */
	function bs_modal_body( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"   => false
    ), $atts );

		$class	 = array();
        $class[] = 'modal-body';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return =sprintf(
        '<div%s%s>
          %s
        </div>',
        $this->class_output($class, $atts['class']),
        $data_props,
				do_shortcode($content)
    );

		return $return;
  }


	/**
	 * Modal footer shortcode
	 * @param  [type] $atts    shortcode attributes
	 * @param  string $content shortcode contents
	 * @return string
	 */
	function bs_modal_footer( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class" => false,
				"data"   => false
    ), $atts );

		$class	 = array();
        $class[] = 'modal-footer';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return = sprintf(
        '<div%s%s>
          %s
        </div>',
        $this->class_output($class, $atts['class']),
        $data_props,
				do_shortcode($content)
    );

		return $return;
  }

	/*--------------------------------------------------------------------------------------
		*
		* bs_color
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_color( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"text"    => false,
				"bg"      => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = ( $atts['text'] ) ? 'text-' . $atts['text'] : '';
		$class[] = ( $atts['bg'] )   ? 'bg-'   . $atts['bg'] : '';

		$return = sprintf(
				'%s',
				do_shortcode( $content )
		);

		$return = $this->addclass( null, $return, $class );
		$return = $this->adddata( null, $return, $atts['data'] );

		return $return;
	}

	/**
	 * Tag border
	 * @param  [type] $atts    shortcode attributes
	 * @param  string $content shortcode contents
	 * @return string
	 */
	function bs_border( $save_atts, $content = null ) {
		$atts = shortcode_atts( array(
			"add"			=> "all",
			"del"			=> false,
			"radius"		=> false,
			"size"			=> false,
			"color"			=> false,
			"class"			=> false,
			"data"			=> false
		), $save_atts );

    	$class	= array();
    	if( $atts['add'] ) {
	    	$add = explode( ' ', $atts['add'] );
		    foreach( $add as $a ):
			    $class[] = ( $a == "all" ? "border" : "border-$a" );
    		endforeach;
	    } else {
	        $class[] = "border";
	    }
    	if( $atts['del'] ) {
	    	$add = explode( ' ', $atts['del'] );
		    foreach( $del as $d ):
			    $class[] = ( $d == "all" ? "border-0" : "border-$d-0" );
    		endforeach;
        }
		$class[] = ( $atts['size'] ) ? 'rounded-' . $atts['size'] : '';
		$class[] = ( $atts['radius'] ) ? ( $atts['radius'] == "all" ) ? 'rounded' : 'rounded-' . $atts['radius'] : '';
		$class[] = ( $atts['color'] ) ? 'border-' . $atts['color'] : '';

		$return = sprintf(
				'%s',
   				do_shortcode( $content )
		);

		$return = $this->addclass( null, $return, $class );

		return $return;
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_figure
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_figure( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = "figure";
		
		$i_class = array();
		$i_class[] = "figure-img";
		$i_class[] = "img-fluid";
		$i_tags = array("img");
		

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return = sprintf(
            '<figure%s%s>%s</figure>',
            $this->class_output($class, $atts['class']),
            $data_props,
			do_shortcode($content)
        );

		$return = $this->addclass( $i_tags, $return, $i_class );

		return $return;
	}
	
	/*--------------------------------------------------------------------------------------
		*
		* bs_figure_caption
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_figure_caption( $atts, $content = null ) {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[]= "figure-caption";

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$return = sprintf(
            '<figcaption%s%s>%s</figcaption>',
            $this->class_output($class, $atts['class']),
            $data_props,
			do_shortcode($content)
        );

		return $return;
	}
	
		/*--------------------------------------------------------------------------------------
		*
		* Parse data-attributes for shortcodes
		*
		*-------------------------------------------------------------------------------------*/
	function parse_data_attributes( $data ) {

		$data_props = '';

		if( $data ) {
			$data = explode( '|', $data );

			foreach( $data as $d ) {
				$d = explode( ',', $d );
				$data_props .= sprintf( ' data-%s="%s"', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
			}
		}

		return $data_props;
	}

	/*--------------------------------------------------------------------------------------
	    * Convert class string array into complete class="..." string and return the string
	    * @param  array   $class  Array with classes
	    * @param  string  $xclass Optional string with extra classes, default null
	    * @param  boolean $flag   Add class="" to string, default true
	    * @return string          class="..." or "..." string (depending on $flag) or empty string
		*-------------------------------------------------------------------------------------*/
	function class_output($class, $xclass = null, $flag = true) {
    	if (empty($class) && empty($xclass)) {
    	    return '';
    	}

        if ($xclass) {
    		$class = array_unique(array_merge($class, explode(' ', $xclass)));
    	}

    	if (empty($class)) {
    	    return '';
    	}
    	
    	$class_string = '';
    	if ($flag) { $class_string .= ' class="';}
    	$class_string .= esc_attr( trim( implode( ' ', array_filter($class) ) ) );
    	if ($flag) { $class_string .= '"';}

		return $class_string;
	}

	/**
	 * Parse a shortcode's contents for a tag and apply classes to each instance
	 * @param  array $finds    Tags to find
	 * @param  string $content DOM content to modify
	 * @param  array $class    Classes to add
	 * @param  string $nth     Number to skip
	 * @return string          Modified DOM content
	 */
	function addclass( $finds, $content, $class, $nth = null ) {
    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);

		if(!$finds) {
			$root = $dom->documentElement;
    		if (isset($GLOBALS['libxml_hack'])) {
    			$root = $root->childNodes->item(0)->childNodes->item(0);
    		}
			$finds = array($root->tagName);
		}

		$count = 0;
		foreach( $finds as $found ) {
			$tags = $dom->getElementsByTagName($found);
			foreach ($tags as $tag) {
				if($nth && $count == $nth) { continue; }
			    if (empty($tag)) { continue; }
				// Append the classes in $class to the tag's existing classes
				$tag->setAttribute(
					'class',
					$this->class_output(
						$class,
						$tag->getAttribute('class'),
						false
					)
				);
				$count++;
			}
		}

		$return = $dom->saveHTML($dom->documentElement);

		if (isset($GLOBALS['libxml_hack'])) {
    		$return = str_replace(array("<html>", "</html>", "<body>", "</body>"), '', $return);
    	}

		return $return;
	}

	/**
	 * Parse a shortcode's contents for a tag and apply data attribute pairs to each instances
	 * @param  array $finds    Tags to find
	 * @param  string $content DOM content to modify
	 * @param  array $data     Data tags to add
	 * @return string          Modified DOM content
	 */
	public static function adddata( $finds, $content, $data ) {
    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);

		if(!$finds) {
			$root = $dom->documentElement;
    		if (isset($GLOBALS['libxml_hack'])) {
    			$root = $root->childNodes->item(0)->childNodes->item(0);
    		}
			$finds = array($root->tagName);
		}

		foreach( $finds as $found ){
			$tags = $dom->getElementsByTagName($found);
			foreach ($tags as $tag) {
				// Set data attributes
				if( $data ) {
					$data = explode( '|', $data );
					foreach( $data as $d ) {
					    if (!empty($d)) {
    						$d = explode(',',$d);
	    					$tag->setAttribute('data-'.$d[0],trim($d[1]));
	    				}
					}
				}
			}
		}

		$return = $dom->saveHTML($dom->documentElement);
		if (isset($GLOBALS['libxml_hack'])) {
    		$return = str_replace(array("<html>", "</html>", "<body>", "</body>"), '', $return);
    	}

		return $return;
	}

	/**
	 * Test DOM for root tags
	 * @param  string   $content DOM content to check
	 * @param  array    $tags    Data tags to find
	 * @return boolean           true = tag found; false = tag not found
	 */
	public static function testdom( $content, $tags ) {
	    if (empty($content) || empty($tags)) {
	        return false;
	    }

    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);

   		if (isset($GLOBALS['libxml_hack'])) {
            if (isset($dom->documentElement->childNodes)) {
       			$tagname = $dom->documentElement->childNodes->item(0)->childNodes->item(0)->tagName;
       		} else {
       		    return false;
       		}
   		} else {
            $tagname = $dom->documentElement->tagName;
   		}

		if(in_array($tagname, $tags)) {
		    return true;
		}

		return false;
	}

	/**
	 * Strip tags by name from DOM
	 */
	public static function striptagfromdom( $tag, $content ) {
    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);
    	$list = $dom->getElementsByTagName($tag);

		while ($list->length > 0) {
		    $p = $list->item(0);
		    $p->parentNode->removeChild($p);
		}

		$return = $dom->saveHTML($dom->documentElement);
		if (isset($GLOBALS['libxml_hack'])) {
    		$return = str_replace(array("<html>", "</html>", "<body>", "</body>"), '', $return);
    	}

		return $return;
    }

	/**
	 * Parse a shortcode's contents for a tag and add a specified area attributes to each instance
	 * @param  [type] $finds   The tags to find
	 * @param  [type] $content The content to search
	 * @param  [type] $key     The key to set
	 * @param  string $value   The value for $key
	 * @param  string $prefix  The optional prefix for $key
	 * @return [type]          The modified $content
	 */
	public static function addattribute( $finds, $content, $key, $value, $prefix = '' ) {
    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);

		if(!$finds) {
			$root = $dom->documentElement;
    		if (isset($GLOBALS['libxml_hack'])) {
    			$root = $root->childNodes->item(0)->childNodes->item(0);
    		}
			$finds = array($root->tagName);
		}

		foreach( $finds as $found ){
			$tags = $dom->getElementsByTagName($found);
			foreach ($tags as $tag) {
				// Set the title attribute
				$tag->setAttribute($prefix . $key, $value);
			}
		}

		$return = $dom->saveHTML($dom->documentElement);
		if (isset($GLOBALS['libxml_hack'])) {
    		$return = str_replace(array("<html>", "</html>", "<body>", "</body>"), '', $return);
    	}

		return $return;
	}

	/**
	 * Count instances of specified class in content
	 * @param  string $classname   Class to count
	 * @param  string $content     The content to search
	 * @return int                 Number of found tags
	 */
	public static function counttags( $classname, $content ) {
    	// Hide warnings while we run this function
	    $previous_value = libxml_use_internal_errors(TRUE);

    	$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    	libxml_clear_errors();
    	libxml_use_internal_errors($previous_value);

        $finder = new DomXPath($dom);
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

		return $nodes->length;
	}

	/**
	 * Get the name of the function that called the current function
	 * @return string                 The calling function's name
	 */
	function getCallingFunctionName() {
			$trace=debug_backtrace();
			$caller=$trace[2];
			$str = $caller['function'];
			if (isset($caller['class']))
				$str .= '-' . $caller['class'];

			return $str;
	}

	/*--------------------------------------------------------------------------------------
		*
		* close_icon
		*
		*
		*-------------------------------------------------------------------------------------*/
	function close_icon( $dismiss ) {

		return '<button type="button" class="close" data-dismiss="' . $dismiss . '" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	}

    /*--------------------------------------------------------------------------------------
		*
		* Add dividers to data attributes content if needed
		*
		*-------------------------------------------------------------------------------------*/
	function check_for_data( $data ) {
		if( $data ) {
			return "|";
		}
	}

    /*--------------------------------------------------------------------------------------
	 * Check if a particular parameter is set as a flag (a parameter without a value) in a shortcode
	 * @param  string  $flag the flag we're looking for
	 * @param  array   $atts an array of the shortcode's attributes
	 * @return boolean true = param is set; false = param is not set
	 */
	public static function is_flag( $flag, $atts ) {
		if(is_array($atts)) {
			foreach ( $atts as $key => $value ) {
				if ( $value === $flag && is_int( $key ) ) return true;
			}
			return false;
		}
	}
}

new BootstrapShortcodes();
