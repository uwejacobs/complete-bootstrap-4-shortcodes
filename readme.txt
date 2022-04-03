=== Bootstrap 4 Shortcodes for WordPress ===
Contributors: uwejacobs
Tags: bootstrap,shortcode,shortcodes,responsive,grid,flex,lorem ipsum,dummy image generator
Donate link: paypal.me/ujsoftware
Requires at least: 3.8
Tested up to: 5.9.2
Requires PHP: 7.0
Stable tag: 4.6.4
License: MIT License
License URI: https://mit-license.org/

Implements Bootstrap 4 styles and components in WordPress through shortcodes.

== Description ==

###Just The Shortcodes, Please
Plenty of great WordPress plugins focus on providing or including the Bootstrap library into your site. **Bootstrap Shortcodes for WordPress** assumes you're working with a theme that already includes Bootstrap 4 and focuses on giving you a great set of shortcodes to use it with.

This plugin creates a simple, out of the way button just above the WordPress TinyMCE editor (next to the "Add Media" button) which pops up the plugin's documentation and shortcode examples for reference and handy "Insert Example" links to send the example shortcodes straight to the editor. There are no additional TinyMCE buttons to clutter up your screen, just great, easy to use shortcodes!

Check the demo page "Bootstrap 4 Shortcodes Demo 4.6.4" after activation for ready to use shortcodes examples.

For questions, support, or to contribute to this plugin, check out [our GitHub project](https://github.com/uwejacobs/complete-bootstrap-4-shortcodes).

== Overview ==

= Layout: =
* Grid
* Responsive Embeds
* Responsive Utilities

= Components: =
* Cards
* Icons
* Buttons
* Button Groups
* Button Dropdowns
* Navs
* Navigation Bars
* Breadcrumbs
* Badges
* Jumbotron
* Alerts
* Progress Bars
* Media Objects
* List Groups

= Content: =
* Code
* Tables
* Figures
* Images
* Blockquote
* Lead body copy
* Wrap section

= Utilities: =
* Border
* Color
* Flex
* HTML snippets
* Line Breaks
* Lorem Ipsum Text Generator
* Floats and Clearfix

= Javascript: =
* Tooltip
* Popover
* Collapse
* Carousel
* Modal

== Screenshots ==
1. Rows and Columns
2. Nested Rows And Columns
3. Card Columns
4. Button Styles and Colors
5. Jumbotron
6. Alert Colors
7. Progress Bar Styles
8. Media Objects
9. Border Examples
10. Flex
11. Tooltips and Popovers
12. Accordion
13. The Bootstrap Shortcodes button in TinyMCE
14. The Modal with the Shortcode Reference
15. Shortcode example in TinyMCE
16. The above shortcode example rendered with WordPress

== Changelog ==
= 4.6.4 =
* Fixed help modal in editor

= 4.6.3 =
* Fixed various aria errors reported by Lighthouse
* Added progress bar patameters for screen readers
* Removed btn-link class from accordion link
* Tested with Wordpress 5.9.1

= 4.6.2 =
* Added javascript snippet to prevent the # links in the demo page to reload the document
* Hide the help modal (display:none) to prevent it from leaking in the admin menu
* Tested with Wordpress 5.9

= 4.6.1 =
* Fixed warnings for custom post types when checking for conditional script includes
* Updated Bootstrap to 4.6.1
* Tested with Wordpress 5.8.2

= 4.6.0 =
* Updated bootstrap to 4.6
* Updated fontawesome to 5.15.4
* Escaped all output consistently
* PHP 7.0 required
* Added donation link (thanks for your consideration)

= 4.5.12 =
* Tested with Wordpress 5.8
* Added option to assign class to the nav-item itself in addition to the link
* Deleted the embedded video example because it creates considerable network load

= 4.5.11 =
* Added collapsible vertical and horizontal navigation bar
* Added bootstrap button to classic editor
* Added [br] shortcode for linebreak
* Fixed extra linebreaks from editor in shortcode contents
  * Added utility classes to demo page for proper spacing
  * Note: This might require minor reformatting for existing pages
* Fixed linefeed when inserting sample snippets in visual and text mode
* Fixed embeded video in help file
* Fixed minor spelling errors
* All plugin generated HTML ids start now with bs4-

= 4.5.10 =
* Fixed all HTML errors reported by https://validator.w3.org
* Fixed list group with linked items
* Fixed several id options

= 4.5.9 =
* Fixed empty modal body and footer
* Fixed warnings in WP_DEBUG mode
* Fixed embedded image source on demo page

= 4.5.8 =
* Added id option to most shortcodes
* Added new [wrapper] shortcode
* Added id and size options to [container]
* Added center option to [img]
* Added plus/minus icons for accordion header
* Added keyboard option to [modal]
* Fix: Renamed [icon] option "type" to "name" in help files, see 4.5.3
* Deleted all blocks in demo page

= 4.5.7 =
* Added clearfix shortcode
* Added float shortcode
* Bugfix: Fixed spelling of `dismissible` for alerts
* Clarified img-thumbnail functionality in documentation
* Minor fixes for shortcode demo page

= 4.5.6 =
* [button] can now create tag <code>a</code> with href and target

= 4.5.5 =
* Bugfix: [card-footer] didn't insert "class" parameter
* Bugfix: [img-gen] will crash when PHP extensions GD and/or FreeType are not installed

= 4.5.4 =
* Bugfix: [list-group] without "linked" flag treated all inline links as [list-group-items]
* Bugfix: Delete all [br] tags, inserted by TinyMCE around shortcodes, during rendering
* Bugfix: will no longer push down class "card-header" to header tags inside card header
* Minor documentation fixes

= 4.5.3 =
* Changed the [icon] attribute "type" to "name" to use same attributes as Font Awesome plugin
* Minor documentation fixes

= 4.5.2 =
* Tested and working in the latest version 4.5.2 of Bootstrap

= 4.5.0 =
* Tested and working in the latest version of Bootstrap!

