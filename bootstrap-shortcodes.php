<?php
/*
Plugin Name: Bootstrap 4 Shortcodes
Plugin URI: (https://github.com/MWDelaney/bootstrap-shortcodes)
Description: The plugin adds shortcodes for all Bootstrap 4 elements.
Version: 4.5.0
Author: Uwe Jacobs; Michael W. Delaney, Filip Stefansson, and Simon Yeldon until 3.3.12
Author URI:
License: MIT
*/

/* ============================================================= */

// ======================================================================== //
// Include necessary functions and files
// ======================================================================== //

		require_once( dirname( __FILE__ ) . '/includes/defaults.php' );
		require_once( dirname( __FILE__ ) . '/includes/functions.php' );
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
			'alert',
			'badge',
			'br',
			'blockquote',
			'blockquote-footer',
			'breadcrumb',
			'breadcrumb-item',
			'button',
			'button-group',
			'button-toolbar',
			'card',
			'card-body',
			'card-columns',
			'card-deck',
			'card-footer',
			'card-group',
			'card-header',
			'card-img-overlay',
			'carousel',
			'carousel-item',
			'code',
			'collapse',
			'collapsibles',
			'column',
			'container',
			'container-fluid',
			'divider',
			'dropdown',
			'dropdown-header',
			'dropdown-item',
			'emphasis',
            'flex',
            'flex-item',
			'icon',
			'icon-stack',
			'img',
			'img-gen',
			'embed-responsive',
			'jumbotron',
			'lead',
			'list-group',
			'list-group-item',
			'list-group-item-heading',
			'list-group-item-text',
			'media',
			'media-body',
			'media-object',
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
			'tab',
			'table-wrap',
			'tabs',
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
		* @author Filip Stefansson, Nicolas Jonas
		* @since 1.0
		* 
		*-------------------------------------------------------------------------------------*/
	function bs_button( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"     => false,
			"size"     => false,
			"block"    => false,
			"dropdown" => false,
			"link"     => '#',
			"target"   => false,
			"disabled" => false,
			"active"   => false,
			"class"    => false,
			"title"    => false,
			"data"     => false
		), $atts );

        $class = array();
		$class[] = 'btn';
		$class[] = ( $atts['type'] )     ? 'btn-' . $atts['type'] : '';
		$class[] = ( $atts['size'] && $atts['size'] != "xs" )     ? 'btn-' . $atts['size'] : '';
		$class[] = ( $atts['block'] == 'true' )    ? 'btn-block' : '';
		$class[] = ( $atts['dropdown']   == 'true' ) ? 'dropdown-toggle' : '';
		$class[] = ( $atts['disabled']   == 'true' ) ? 'disabled' : '';
		$class[] = ( $atts['active']     == 'true' )   ? 'active' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<a href="%s"%s%s%s%s>%s</a>',
			esc_url( $atts['link'] ),
			$this->class_output ( $class, $atts["class"] ),
			( $atts['target'] )     ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
			( $atts['title'] )      ? sprintf( ' title="%s"',  esc_attr( $atts['title'] ) )  : '',
			$data_props,
			do_shortcode( $content )
		);

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button_group
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_group( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"size"      => false,
				"vertical"  => false,
				"justified" => false,
				"dropup"    => false,
				"class"     => false,
				"data"      => false
		), $atts );

        $class = array();
		$class[] = 'btn-group';
		$class[] = ( $atts['size'] && $atts['size'] != "xs" ) ? 'btn-group-' . $atts['size'] : '';
		$class[] = ( $atts['vertical']   == 'true' )          ? 'btn-group-vertical' : '';
		$class[] = ( $atts['justified']  == 'true' )          ? 'btn-group-justified' : '';
		$class[] = ( $atts['dropup']     == 'true' )          ? 'dropup' : '';

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
		* bs_button_toolbar
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_toolbar( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'btn-toolbar';

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
		* bs_container
		*
		* @author Robin Wouters
		* @since 3.0.3.3
		*
		*-------------------------------------------------------------------------------------*/
	function bs_container( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"fluid"  => false,
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = ( $atts['fluid']   == 'true' )  ? 'container-fluid' : 'container';

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

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

        $class = array();
		$class[] = 'dropdown-menu';

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
	function bs_dropdown_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"link"        => '#',
				"disabled"    => false,
				"class"       => false,
				"data"        => false
		), $atts );

        $class = array();
		$class[] = 'dropdown-item';
		$class[] = ( $atts['disabled']  == 'true' ) ? 'disabled' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<a role="menuitem" href="%s"%s%s>%s</a>',
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
	function bs_divider( $atts, $content = null ) {

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

	/*--------------------------------------------------------------------------------------
		*
		* bs_nav
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav( $atts, $content = null ) {

		$atts = shortcode_atts( array(
					"type"      => false,
					"stacked"   => false,
					"justified" => false,
					"class"     => false,
					"data"      => false
		), $atts );

        $class = array();
		$class[] = 'nav';
		$class[] = ( $atts['type'] )                ? 'nav-' . $atts['type'] : 'nav-tabs';
		$class[] = ( $atts['stacked']   == 'true' ) ? 'nav-stacked' : '';
		$class[] = ( $atts['justified'] == 'true' ) ? 'nav-justified' : '';

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
		* bs_nav_item
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"link"     => '#',
				"active"   => false,
				"disabled" => false,
				"dropdown" => false,
				"class"    => false,
				"data"     => false,
		), $atts );

        $li_class = array();
		$li_class[] = ( $atts['dropdown'] )           ? 'dropdown' : '';
		$li_class[] = ( $atts['active']   == 'true' ) ? 'active' : '';
		$li_class[] = ( $atts['disabled'] == 'true' ) ? 'disabled' : '';

		$a_class = array();
		$a_class[] = ( $atts['dropdown']   == 'true' ) ? 'dropdown-toggle' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		//* If we have a dropdown shortcode inside the content we end the link before the dropdown shortcode, else all content goes inside the link
		$content = ( $atts['dropdown'] ) ? str_replace( '[dropdown]', '</nav-link>[dropdown]', $content ) : $content . '</nav-link>';

		return sprintf(
			'<nav-item%1$s><nav-link href="%2$s"%3$s%4$s%5$s>%6$s</nav-item>',
			$this->class_output ( $li_class ),
			esc_url( $atts['link'] ),
			$this->class_output ( $a_class, $atts["class"] ),
			( $atts['dropdown'] )   ? ' data-toggle="dropdown"' : '',
			$data_props,
			do_shortcode( $content )
		);

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_card_deck
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_deck( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => null,
				"data"    => false
		), $atts );

        $class = array();
		$class[] = 'card-deck';

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
		* bs_card_columns
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_columns( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

        $class = array();
		$class[] = 'card-columns';

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
		* bs_card_group
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_group( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = 'card-group';

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
		* bs_card
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

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
		* bs_card_header
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_header( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

        $class = array();
		$class[] = 'card-header';

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
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_body( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

        $class = array();
		$class[] = 'card-body';

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
		* bs_card_footer
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card_footer( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
		), $atts );

        $class = array();
		$class[] = 'card-footer';

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
		* bs_img_overlay
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_img_overlay( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"   => false,
				"data"    => false
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
		* bs_alert
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_alert( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"type"          => false,
				"dismissable"   => false,
				"class"         => false,
				"data"          => false
		), $atts );

		$class = array();
		$class[] = 'alert';
		$class[] = ( $atts['type'] )                   ? 'alert-' . $atts['type'] : 'alert-success';
		$class[] = ( $atts['dismissable'] == 'true' )  ? 'alert-dismissable' : '';

		$dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s%s</div>',
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
	function bs_progress( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"striped"   => false,
				"animated"  => false,
				"class"     => false,
				"data"      => false
		), $atts );

		$class = array();
		$class[] = 'progress';
		$class[] = ( $atts['striped']  == 'true' )  ? 'progress-striped' : '';
		$class[] = ( $atts['animated']  == 'true' ) ? 'progress-bar-animated' : '';

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
	function bs_progress_bar( $atts, $content = null ) {

		$atts = shortcode_atts( array(
					"type"      => false,
					"percent"   => false,
					"label"     => false,
					"class"     => false,
					"data"      => false
		), $atts );

		$class = array();
		$class[] = 'progress-bar';
		$class[] = ( $atts['type'] ) ? 'bg-' . $atts['type'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s role="progressbar" %s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			( $atts['percent'] )      ? ' aria-value="' . (int) $atts['percent'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . (int) $atts['percent'] . '%;"' : '',
			$data_props,
			( $atts['percent'] )      ? sprintf('<span%s>%s</span>', ( !$atts['label'] ) ? ' class="sr-only"' : '', (int) $atts['percent'] . '% Complete') : ''
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
	function bs_code( $atts, $content = null ) {

		$atts = shortcode_atts( array(
					"inline"      => false,
					"scrollable"  => false,
					"class"       => false,
					"data"        => false
		), $atts );

		$class = array();
		$class[] = '';
		$class[] = ( $atts['scrollable']   == 'true' )  ? 'pre-scrollable' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s%2$s%3$s>%4$s</%1$s>',
			( $atts['inline'] ) ? 'code' : 'pre',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
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
	function bs_row( $atts, $content = null ) {

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
	function bs_column( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"xl"          => false,
				"lg"          => false,
				"md"          => false,
				"sm"          => false,
				"xs"          => false,
				"offset_xl"   => false,
				"offset_lg"   => false,
				"offset_md"   => false,
				"offset_sm"   => false,
				"offset_xs"   => false,
				"order_xl"    => false,
				"order_lg"    => false,
				"order_md"    => false,
				"order_sm"    => false,
				"order_xs"    => false,
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
		$class[] = ( $atts['offset_xl'] || $atts['offset_xl'] === "0" ) ? 'offset-xl-' . $atts['offset_xl'] : '';
		$class[] = ( $atts['offset_lg'] || $atts['offset_lg'] === "0" ) ? 'offset-lg-' . $atts['offset_lg'] : '';
		$class[] = ( $atts['offset_md'] || $atts['offset_md'] === "0" ) ? 'offset-md-' . $atts['offset_md'] : '';
		$class[] = ( $atts['offset_sm'] || $atts['offset_sm'] === "0" ) ? 'offset-sm-' . $atts['offset_sm'] : '';
		$class[] = ( $atts['offset_xs'] || $atts['offset_xs'] === "0" ) ? 'offset-' . $atts['offset_xs'] : '';
		$class[] = ( $atts['order_xl']  || $atts['order_xl']  === "0" ) ? 'order-xl-' . $atts['pull_xl'] : '';
		$class[] = ( $atts['order_lg']  || $atts['order_lg']  === "0" ) ? 'order-lg-' . $atts['pull_lg'] : '';
		$class[] = ( $atts['order_md']  || $atts['order_md']  === "0" ) ? 'order-md-' . $atts['pull_md'] : '';
		$class[] = ( $atts['order_sm']  || $atts['order_sm']  === "0" ) ? 'order-sm-' . $atts['pull_sm'] : '';
		$class[] = ( $atts['order_xs']  || $atts['order_xs']  === "0" ) ? 'order-' . $atts['pull_xs'] : '';

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
	function bs_flex( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"size"                  => false,
				"inline"                => false,
				"row"                   => false,
				"row-reverse"           => false,
				"column"                => false,
				"column-reverse"        => false,
				"wrap"                  => false,
				"no-wrap"               => false,
				"wrap-reverse"          => false,
				"class"                 => false,
				"data"                  => false
		), $atts );

		$class = array();
		$class_str  = 'd';
		$class_str .= ( $atts['size']   && $atts['size']   !=  "xs" )  ? '-' . $atts['size'] : '';
		$class_str .= ( $atts['inline'] || $atts['inline'] === "1"  )  ? '-inline' : '';
		$class_str .= '-flex';
        $class[] = $class_str;
		if ($atts['row']) {
            $opts = explode(' ', $atts['row']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : $opt ) . '-row';
            }
		}
		if ($atts['row-reverse']) {
            $opts = explode(' ', $atts['row-reverse']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-row-reverse';
            }
		}
		if ($atts['column']) {
            $opts = explode(' ', $atts['column']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-column';
            }
		}
		if ($atts['column-reverse']) {
            $opts = explode(' ', $atts['column-reverse']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-column-reverse';
            }
		}
		if ($atts['wrap']) {
            $opts = explode(' ', $atts['wrap']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-wrap';
            }
		}
		if ($atts['no-wrap']) {
            $opts = explode(' ', $atts['no-wrap']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-nowrap';
            }
		}
		if ($atts['wrap-reverse']) {
            $opts = explode(' ', $atts['wrap-reverse']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-wrap-reverse';
            }
		}

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
	function bs_flex_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"fill"                => false,
				"grow"                => false,
				"no-grow"             => false,
				"shrink"              => false,
				"no-shrink"           => false,
				"class"               => false,
				"data"                => false
		), $atts );

		$class = array();

		if ($atts['fill']) {
            $opts = explode(' ', $atts['fill']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : $opt ) . '-fill';
            }
		}
		if ($atts['grow']) {
            $opts = explode(' ', $atts['grow']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-grow-1';
            }
		}
		if ($atts['no-grow']) {
            $opts = explode(' ', $atts['no-grow']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-grow-0';
            }
		}
		if ($atts['shrink']) {
            $opts = explode(' ', $atts['shrink']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-shrink-1';
            }
		}
		if ($atts['no-shrink']) {
            $opts = explode(' ', $atts['no-shrink']);
            foreach($opts as $opt) {
		        $class[] = 'flex' . ( $opt == "xs" ? '' : '-' . $opt ) . '-shrink-0';
            }
		}

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
		* bs_list_group
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"linked" => false,
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'list-group';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s%2$s%3$s>%4$s</%1$s>',
			( $atts['linked'] == 'true' ) ? 'div' : 'ul',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"link"    => '#',
				"type"    => false,
				"active"  => false,
				"target"  => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = 'list-group-item';
		$class[] = ( $atts['type'] )                 ? 'list-group-item-' . $atts['type'] : '';
		$class[] = ( $atts['active']   == 'true' )   ? 'active' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s %2$s %3$s%4$s%5$s>%6$s</%1$s>',
			( $atts['link'] )     ? 'a' : 'li',
			( $atts['link'] )     ? 'href="' . esc_url( $atts['link'] ) . '"' : '',
			( $atts['target'] )   ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item_heading
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item_heading( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'list-group-item-heading';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<h4%s%s>%s</h4>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item_text
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item_text( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'list-group-item-text';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<p%s%s>%s</p>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_breadcrumb
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_breadcrumb( $atts, $content = null ) {

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
	function bs_breadcrumb_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"link" => '#',
				"class"  => false,
				"active" => false,
				"data" => false
		), $atts );

		$class = array();

        $li_class = array();
		$li_class[] = 'breadcrumb-item';
		$li_class[] = ( $atts['active'] == 'true' )  ? 'active' : '';

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
		    ( $atts['active'] == 'true' ) ? $content : $link
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
	function bs_badge( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"right"   => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = 'badge';
		$class[] = ( $atts['right']   == 'true' ) ? 'pull-right' : '';

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
	function bs_table_wrap( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"bordered"   => false,
				"striped"    => false,
				"hover"      => false,
				"condensed"  => false,
				"responsive" => false,
				"class"      => false,
				"data"       => false
		), $atts );

		$class  = 'table';
		$class .= ( $atts['bordered']  == 'true' ) ? ' table-bordered' : '';
		$class .= ( $atts['striped']   == 'true' ) ? ' table-striped' : '';
		$class .= ( $atts['hover']     == 'true' ) ? ' table-hover' : '';
		$class .= ( $atts['condensed'] == 'true' ) ? ' table-sm' : '';
		$class .= ( $atts['class'] )               ? ' ' . $atts['class'] : '';

		$tag = array('table');
		$content = do_shortcode($content);
		$return .= $this->scrape_dom_element($tag, $content, $class, '', $atts['data']);
		
		$return = ( $atts['responsive'] ) ? '<div class="table-responsive">' . $return . '</div>' : $return;
		return $return;
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_tabs
		*
		* @author Filip Stefansson
		* @since 1.0
		* Modified by TwItCh twitch@designweapon.com
		* Now acts a whole nav/tab/pill shortcode solution!
		*-------------------------------------------------------------------------------------*/
	function bs_tabs( $atts, $content = null ) {

		if( isset( $GLOBALS['tabs_count'] ) )
			$GLOBALS['tabs_count']++;
		else
			$GLOBALS['tabs_count'] = 0;

		$GLOBALS['tabs_default_count'] = 0;

		$atts = apply_filters('bs_tabs_atts',$atts);

		$atts = shortcode_atts( array(
				"type"    => false,
				"class"   => false,
				"data"    => false,
				"name"    => false,
		), $atts );

        $ul_class = array();
		$ul_class[] = 'nav';
		$ul_class[] = ( $atts['type'] )     ? 'nav-' . $atts['type'] : 'nav-tabs';

        $div_class = array();
        $div_class[] = 'tab-content';

		// If user defines name of group, use that for ID for tab history purposes
		if(isset($atts['name'])) {
			$id = $atts['name'];
		} else {
			$id = 'custom-tabs-' . $GLOBALS['tabs_count'];
		}

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$atts_map = bs_attribute_map( $content );

		// Extract the tab titles for use in the tab widget.
		if ( $atts_map ) {
			$tabs = array();
			$GLOBALS['tabs_default_active'] = true;
			foreach( $atts_map as $check ) {
					if( !empty($check["tab"]["active"]) ) {
							$GLOBALS['tabs_default_active'] = false;
					}
			}
			$i = 0;
			foreach( $atts_map as $tab ) {

                $li_class = array();
				$li_class[] ='nav-item';
				$li_class[] = ( !empty($tab["tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? 'active' : '';
				$li_class[] = ( !empty($tab["tab"]["class"]) )                                                  ? esc_attr($tab["tab"]["class"]) : '';

				if(!isset($tab["tab"]["link"])) {
					$tab_id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5( $tab["tab"]["title"] );
				} else {
					$tab_id = $tab["tab"]["link"];
				}

				$tabs[] = sprintf(
					'<li%s><a class="nav-link" href="#%s" data-toggle="tab" >%s</a></li>',
        			$this->class_output ( $li_class ),
					sanitize_html_class($tab_id),
					$tab["tab"]["title"]
				);
				$i++;
			}
		}
		$output = sprintf(
			'<ul%s id="%s"%s>%s</ul><div%s>%s</div>',
			$this->class_output ( $ul_class, $atts["class"] ),
			sanitize_html_class( $id ),
			$data_props,
			( $tabs )  ? implode( $tabs ) : '',
			$this->class_output ( $div_class ),
			do_shortcode( $content )
		);

		return apply_filters('bs_tabs', $output);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_tab
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_tab( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"title"   => false,
				"active"  => false,
				"fade"    => false,
				"class"   => false,
				"data"    => false,
				"link"    => false
		), $atts );

		if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
				$atts['active'] = true;
		}
		$GLOBALS['tabs_default_count']++;

        $class = array();
		$class[] = 'tab-pane';
		$class[] = ( $atts['fade']   == 'true' )                            ? 'fade' : '';
		$class[] = ( $atts['active'] == 'true' )                            ? 'active' : '';
		$class[] = ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? 'in' : '';

		if(!isset($atts['link']) || $atts['link'] == NULL) {
			$id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5( $atts['title'] );
		} else {
			$id = $atts['link'];
		}
		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div id="%s"%s%s>%s</div>',
			sanitize_html_class($id),
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_collapsibles
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_collapsibles( $atts, $content = null ) {

		if( isset($GLOBALS['collapsibles_count']) )
			$GLOBALS['collapsibles_count']++;
		else
			$GLOBALS['collapsibles_count'] = 0;

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();

		$id = 'custom-collapse-'. $GLOBALS['collapsibles_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s id="%s"%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			esc_attr($id),
			$data_props,
			do_shortcode( $content )
		);

	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_collapse
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_collapse( $atts, $content = null ) {

		if( isset($GLOBALS['single_collapse_count']) )
			$GLOBALS['single_collapse_count']++;
		else
			$GLOBALS['single_collapse_count'] = 0;

		$atts = shortcode_atts( array(
				"title"   => false,
				"type"    => false,
				"active"  => false,
				"class"   => false,
				"lclass"  => false,
				"bclass"  => false,
				"hclass"  => false,
				"data"    => false
		), $atts );

        $card_class = array();
		$card_class[] = 'card';
		$card_class[] = ( $atts['type'] )     ?  'bg-' . $atts['type'] : '';

        $collapse_class = array();
		$collapse_class[] = 'collapse';
		$collapse_class[] = ( $atts['active'] == 'true' )  ? 'show' : '';

        $a_class = array();
		$a_class[] = 'card-link';

		$b_class = array();
		$b_class[] = 'card-body';

		$h_class = array();
		$h_class[] = 'card-header';

		$parent = isset( $GLOBALS['collapsibles_count'] ) ? 'custom-collapse-' . $GLOBALS['collapsibles_count'] : 'single-collapse';
		$current_collapse = $parent . '-' . $GLOBALS['single_collapse_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%1$s%2$s>
				<div%10$s>
					<h4 class="card-title">
						<a%3$s data-toggle="collapse" href="#%5$s">%6$s</a>
					</h4>
				</div>
				<div id="%5$s"%7$s%4$s>
					<div%9$s>%8$s</div>
				</div>
			</div>',
			$this->class_output ( $card_class, $atts["class"] ),
			$data_props,
			$this->class_output ( $a_class, $atts["lclass"] ),
			( $parent && $parent != 'single-collapse' )       ? ' data-parent="#' . $parent . '"' : '',
			$current_collapse,
			$atts['title'],
			$this->class_output ( $collapse_class ),
			do_shortcode( $content ),
			$this->class_output ( $b_class, $atts["bclass"] ),
			$this->class_output ( $h_class, $atts["hclass"] )
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel
		*
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel( $atts, $content = null ) {

		if( isset($GLOBALS['carousel_count']) )
			$GLOBALS['carousel_count']++;
		else
			$GLOBALS['carousel_count'] = 0;

		$GLOBALS['carousel_default_count'] = 0;

		$atts = shortcode_atts( array(
				"interval"  => false,
				"pause"     => 'hover',
				"wrap"      => false,
				"indicator" => 'true',
				"arrows"    => 'true',
				"class"     => false,
				"data"      => false,
		), $atts );

        $div_class = array();
		$div_class[] = 'carousel slide';

        $inner_class = array();
		$inner_class[] = 'carousel-inner';

		$id = 'custom-carousel-'. $GLOBALS['carousel_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$atts_map = bs_attribute_map( $content );

		// Extract the slide titles for use in the carousel widget.
		if ( ( $atts['indicator'] && $atts['indicator'] == "true" ) && $atts_map ) {
			$indicators = array();
			$GLOBALS['carousel_default_active'] = true;
			foreach( $atts_map as $check ) {
				if( !empty($check["carousel-item"]["active"]) ) {
					$GLOBALS['carousel_default_active'] = false;
				}
			}
			$i = 0;
			foreach( $atts_map as $slide ) {
				$indicators[] = sprintf(
					'<li%s data-target="%s" data-slide-to="%s"></li>',
					( !empty($slide["carousel-item"]["active"]) || ($GLOBALS['carousel_default_active'] && $i == 0) ) ? 'active' : '',
					esc_attr( '#' . $id ),
					esc_attr( $i )
				);
				$i++;
			}
		}
		return sprintf(
			'<div%s id="%s" data-ride="carousel"%s%s%s%s>%s<div%s>%s%s',
			$this->class_output ( $div_class, $atts["class"] ),
			esc_attr( $id ),
			( $atts['interval'] )   ? sprintf( ' data-interval="%d"', $atts['interval'] ) : '',
			( $atts['pause'] )      ? sprintf( ' data-pause="%s"', esc_attr( $atts['pause'] ) ) : '',
			( $atts['wrap'] == 'true' )       ? sprintf( ' data-wrap="%s"', esc_attr( $atts['wrap'] ) ) : '',
			$data_props,
			( $indicators ) ? '<ol class="carousel-indicators">' . implode( $indicators ) . '</ol>' : '',
			$this->class_output ( $inner_class ),
			do_shortcode( $content ),
			( $atts['arrows'] && $atts['arrows'] == "false" ) ? '' :
			'<div><a class="carousel-control-prev"  href="' . esc_url( '#' . $id ) . '" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>' .
			'<a class="carousel-control-next" href="' . esc_url( '#' . $id ) . '" data-slide="next"><span class="carousel-control-next-icon"></span></a></div>'
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel_item
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"active"  => false,
				"caption" => false,
				"class"   => false,
				"data"    => false
		), $atts );

		if( $GLOBALS['carousel_default_active'] && $GLOBALS['carousel_default_count'] == 0 ) {
				$atts['active'] = true;
		}
		$GLOBALS['carousel_default_count']++;

		$class = array();
		$class[] = 'carousel-item';
		$class[] = ( $atts['active']   == 'true' ) ? 'active' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		//$content = preg_replace('/class=".*?"/', '', $content);
		$content = preg_replace('/alignnone/', '', $content);
		$content = preg_replace('/alignright/', '', $content);
		$content = preg_replace('/alignleft/', '', $content);
		$content = preg_replace('/aligncenter/', '', $content);

		return sprintf(
			'<div%s%s>%s%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content ),
			( $atts['caption'] ) ? '<div class="carousel-caption">' . esc_html( $atts['caption'] ) . '</div>' : ''
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_tooltip
		*
		* @author
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/


	function bs_tooltip( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			 'title'     => '',
			 'placement' => 'top',
			 'animation' => 'true',
			 'html'      => 'false',
			 'data'      => ''
		), $atts );

		$class = 'bs-tooltip';

		$atts['data']   .= $this->check_for_data($atts['data']) . 'toggle,tooltip';
		$atts['data']   .= ( $atts['animation'] ) ? $this->check_for_data($atts['data']) . 'animation,' . $atts['animation'] : '';
		$atts['data']   .= ( $atts['placement'] ) ? $this->check_for_data($atts['data']) . 'placement,' . $atts['placement'] : '';
		$atts['data']   .= ( $atts['html'] )      ? $this->check_for_data($atts['data']) . 'html,'      .$atts['html']      : '';

		$return = '';
		$tag = 'span';
		$content = do_shortcode($content);
		$return .= $this->get_dom_element($tag, $content, $class, $atts['title'], $atts['data']);
		return $return;

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_popover
		*
		*
		*-------------------------------------------------------------------------------------*/

	function bs_popover( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				'title'     => false,
				'text'      => '',
				'placement' => 'top',
				'animation' => 'true',
				'html'      => 'false',
				'data'      => ''
		), $atts );

		$class = 'bs-popover';

		$atts['data'] .= $this->check_for_data($atts['data']) . 'toggle,popover';
		$atts['data'] .= $this->check_for_data($atts['data']) . 'content,' . str_replace(',', '&#44;', $atts['text']);
		$atts['data'] .= ( $atts['animation'] ) ? $this->check_for_data($atts['data']) . 'animation,' . $atts['animation'] : '';
		$atts['data'] .= ( $atts['placement'] ) ? $this->check_for_data($atts['data']) . 'placement,' . $atts['placement'] : '';
		$atts['data'] .= ( $atts['html'] )      ? $this->check_for_data($atts['data']) . 'html,'      . $atts['html']      : '';

		$return = '';
		$tag = 'span';
		$content = do_shortcode($content);
		$return .= $this->get_dom_element($tag, $content, $class, $atts['title'], $atts['data']);
		return html_entity_decode($return);

	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_media
		*
		* @author
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/

	function bs_media( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'media';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

    function bs_media_object( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"align " => false,
				"class"  => false,
				"data"   => false
		), $atts );

		$class  = '';
		$class .= ( $atts['align'] )   ? 'align-self-' . $atts['align']: '';

		$return = '';

		$tag = array('figure', 'div', 'img', 'i', 'span');
		$content = do_shortcode(preg_replace('/(<br>)+$/', '', $content));
		$return .= $this->scrape_dom_element($tag, $content, $class, '', $atts['data']);
		return $return;
	}

	function bs_media_body( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"title"  => false,
				"class"  => false,
				"data"   => false
		), $atts );

        $div_class = array();
		$div_class[] = 'media-body';

        $h4_heading = array();
		$h4_class[] = 'media-heading';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s><h4%s>%s</h4>%s</div>',
			$this->class_output ( $div_class, $atts["class"] ),
			$data_props,
			$this->class_output ( $h4_class ),
			esc_html(  $atts['title']),
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_jumbotron
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_jumbotron( $atts, $content = null ) {

		$atts = shortcode_atts( array(
					"title"  => false,
					"class"  => false,
					"data"   => false
		), $atts );

		$class = array();
		$class[] = 'jumbotron';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			( $atts['title'] ) ? '<h1>' . esc_html( $atts['title'] ) . '</h1>' : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_lead
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_lead( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false
		), $atts );

		$class = array();
		$class[] = 'lead';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<p%s%s>%s</p>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_br
		*
		* @author Uwe Jacobs
		* @since 4.5.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_br( $atts, $content = null ) {

		return '<br>';
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_emphasis
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_emphasis( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"type"    => false,
				"bgtype"  => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$class = array();
		$class[] = ( $atts['type'] )     ? 'text-' . $atts['type'] : 'text-muted';
		$class[] = ( $atts['bgtype'] )   ? 'bg-' . $atts['bgtype'] : '';

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
		* bs_img
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_img( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"type"       => false,
				"responsive" => false,
				"class"      => false,
				"data"       => false
		), $atts );

        if ($atts['type']) {
            if ($atts['type'] == 'circle') {
            	$atts['type'] = 'rounded-circle';
            } else if ($atts['type'] == 'thumbnail') {
            	$atts['type'] = 'img-thumbnail';
            }
		}

		$class  = '';
		$class .= ( $atts['type'] )                   ? ' ' . $atts['type'] : '';
		$class .= ( $atts['responsive']   == 'true' ) ? ' img-fluid' : '';
		$class .= ( $atts['class'] )                  ? ' ' . $atts['class'] : '';

		$return = '';
		$tag = array('img');
		$content = do_shortcode($content);
		$return .= $this->scrape_dom_element($tag, $content, $class, '', $atts['data']);
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
		$atts = shortcode_atts( array(
				"type"          => false,
				"responsive"    => false,
				"size"          => false,
				"file"          => false,
				"text"          => false,
				"bg"            => false,
				"color"         => false,
				"data"          => false
		), $atts );

        if ($atts['type']) {
            if ($atts['type'] == 'circle') {
            	$atts['type'] = 'rounded-circle';
            } else if ($atts['type'] == 'thumbnail') {
            	$atts['type'] = 'img-thumbnail';
            }
		}

		$class = array();
		$class[] = ( $atts['type'] )                   ? $atts['type'] : '';
		$class[] = ( $atts['responsive']   == 'true' ) ? 'img-fluid' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

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

		return sprintf(
			'<img src="data:%s;base64,%s"%s%s alt="Generated Dummy Image" />',
			$img_type,
			base64_encode( $img_data ),
			$this->class_output ( $class, $atts["class"] ),
			$data_props
		);
    }

	/*--------------------------------------------------------------------------------------
		*
		* bs_blockquote
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_blockquote( $atts, $content = null ) {

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

		$atts = shortcode_atts( array(
				"ratio"      => false,
				"class"      => false,
				"data"       => false
		), $atts );

		$class = array();
		$class[] = 'embed-responsive ';
		$class[] = ( $atts['ratio'] )       ? 'embed-responsive-' . $atts['ratio'] . ' ' : '';

		$embed_class = 'embed-responsive-item';

		$tag = array('iframe', 'embed', 'video', 'object');
		$content = do_shortcode($content);
		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div%s%s>%s</div>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			$this->scrape_dom_element($tag, $content, $embed_class, '', '')
		);

	}


		/*--------------------------------------------------------------------------------------
		*
		* bs_responsive
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_responsive( $atts, $content = null ) {

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
			'<span%s%s>%s</span>',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal( $atts, $content = null ) {

		if( isset($GLOBALS['modal_count']) )
			$GLOBALS['modal_count']++;
		else
			$GLOBALS['modal_count'] = 0;

		$atts = shortcode_atts( array(
				"text"    => false,
				"title"   => false,
				"size"    => false,
				"class"   => false,
				"data"    => false
		), $atts );

		$a_class = array();

        $div_class = array();
		$div_class[] = 'modal fade';
		$div_class[] = ( $atts['size'] ) ? 'bs-modal-' . $atts['size'] : '';

        $md_class = array();
        $md_class[] = 'modal-dialog';
		$md_class[] = ( $atts['size'] ) ? ' modal-' . $atts['size'] : '';

		$id = 'custom-modal-' . $GLOBALS['modal_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$modal_output = sprintf(
				'<div%1$s id="%2$s" tabindex="-1" role="dialog" aria-hidden="true">
						<div%3$s">
								<div class="modal-content">
										<div class="modal-header">
												%4$s
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
										</div>
										<div class="modal-body">
												%5$s
										</div>
								</div>
						</div>
				</div>
				',
			$this->class_output ( $div_class ),
			esc_attr( $id ),
			$this->class_output ( $md_class ),
			( $atts['title'] ) ? '<h4 class="modal-title">' . $atts['title'] . '</h4>' : '',
			do_shortcode( $content )
		);

		add_action('wp_footer', function() use ($modal_output) {
				echo $modal_output;
		}, 100,0);

		return sprintf(
			'<a data-toggle="modal" href="#%1$s"%2$s%3$s>%4$s</a>',
			esc_attr( $id ),
			$this->class_output ( $a_class, $atts["class"] ),
			$data_props,
			esc_html( $atts['text'] )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal_header
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal_header( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false,
		), $atts );

		$class = array();
		$class[] = 'modal-header';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'</div><div%s%s>%s',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal_body
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal_body( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false,
		), $atts );

		$class = array();
		$class[] = 'modal-body';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'</div><div%s%s>%s',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal_footer
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal_footer( $atts, $content = null ) {

		$atts = shortcode_atts( array(
				"class"  => false,
				"data"   => false,
		), $atts );

		$class = array();
		$class[] = 'modal-footer';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'</div><div%s%s>%s',
			$this->class_output ( $class, $atts["class"] ),
			$data_props,
			do_shortcode( $content )
		);
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
	    * Convert class  string array into complete class="..." string and return the string
	    * @param  array $class Array with classes
	    * @param  string $xclass Optional string with extra classes
	    * @return class="..." string or empty string
		*-------------------------------------------------------------------------------------*/
	function class_output($class, $xclass = null) {
        if ($xclass) {
    		$class = array_merge($class, explode(' ', $xclass));
    	}
		return (empty($class) ? '' : ' class="' .  esc_attr( trim( implode( ' ', $class ) ) ) . '"');
	}
		
	/*--------------------------------------------------------------------------------------
		*
		* get DOMDocument element and apply shortcode parameters to it. Create the element if it doesn't exist
		*
		*-------------------------------------------------------------------------------------*/
		function get_dom_element( $tag, $content, $class, $title = '', $data = null ) {

			//clean up content
			$content = trim(trim($content), chr(0xC2).chr(0xA0));
			$previous_value = libxml_use_internal_errors(TRUE);

			$dom = new DOMDocument;
			$dom->loadXML(utf8_encode($content));

			libxml_clear_errors();
			libxml_use_internal_errors($previous_value);

			if(!$dom->documentElement) {
					$element = $dom->createElement($tag, utf8_encode($content));
					$dom->appendChild($element);
			}

			$dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . esc_attr( utf8_encode($class) ));
			if( $title ) {
					$dom->documentElement->setAttribute('title', $title );
			}
			if( $data ) {
					$data = explode( '|', $data );
					foreach( $data as $d ):
					$d = explode(',',$d);
					$dom->documentElement->setAttribute('data-'.$d[0],trim($d[1]));
					endforeach;
			}
			return utf8_decode( $dom->saveXML($dom->documentElement) );
	}

	/*--------------------------------------------------------------------------------------
		*
		* Scrape the shortcode's contents for a particular DOMDocument tag or tags, pull them out, apply attributes, and return just the tags.
		*
		*-------------------------------------------------------------------------------------*/
	function scrape_dom_element( $tag, $content, $class, $title = '', $data = null ) {

			$previous_value = libxml_use_internal_errors(TRUE);

			$dom = new DOMDocument;
			$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

			libxml_clear_errors();
			libxml_use_internal_errors($previous_value);
			foreach ($tag as $find) {
					$tags = $dom->getElementsByTagName($find);
					foreach ($tags as $find_tag) {
							$outputdom = new DOMDocument;
							$new_root = $outputdom->importNode($find_tag, true);
							$outputdom->appendChild($new_root);

							if(is_object($outputdom->documentElement)) {
									$outputdom->documentElement->setAttribute('class', $outputdom->documentElement->getAttribute('class') . ' ' . esc_attr( $class ));
									if( $title ) {
											$outputdom->documentElement->setAttribute('title', $title );
									}
									if( $data ) {
											$data = explode( '|', $data );
											foreach( $data as $d ):
												$d = explode(',',$d);
												$outputdom->documentElement->setAttribute('data-'.$d[0],trim($d[1]));
											endforeach;
									}
							}
						return $outputdom->saveHTML($outputdom->documentElement);

					}
				}
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
		*
		* If the user puts a return between the shortcode and its contents, sometimes we want to strip the resulting P tags out
		*
		*-------------------------------------------------------------------------------------*/
	function strip_paragraph( $content ) {
			$content = str_ireplace( '<p>','',$content );
			$content = str_ireplace( '</p>','',$content );
			return $content;
	}

}

new BootstrapShortcodes();
