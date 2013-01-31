<?php
/*
Plugin Name: Page Template Dashboard
Plugin URI: http://tommcfarlin.com/page-template-dashboard/
Description: An easy way to see which templates your pages are using without having to view the page editor.
Version: 1.0
Author: Tom McFarlin
Author URI: http://tommcfarlin.com/
Author Email: tom@tommcfarlin.com
License:

  Copyright 2013 Tom McFarlin (tom@tommcfarlin.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class PageTemplateDashboard {
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 *
	 * @version	1.0
	 * @since	1.0
	 */
	function __construct() {
	
		// Load plugin textdomain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );
	
		// Define the actions and filters
	    add_filter( 'manage_edit-page_columns', array( $this, 'add_template_column' ) );
	    add_action( 'manage_page_posts_custom_column', array( $this, 'add_template_data' ) );

	} // end constructor
	
	/*--------------------------------------------*
	 * Core Functions
	 *--------------------------------------------*/
	
	/**
	 * Loads the plugin text domain for translation
	 *
	 * @version	1.0
	 * @since	1.0
	 */
	public function plugin_textdomain() {
		load_plugin_textdomain( 'page-template-dashboard', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	} // end plugin_textdomain
	
	/*--------------------------------------------*
	 * Filters
	 *--------------------------------------------*/
	
	/**
	 * Introduces a new column to the 'Page' dashboard that will be used to render the page template
	 * for the given page.
	 *
	 * @param	array	$page_columns	The array of columns rendering page meta data./
	 * @return	array					The update array of page columns.
	 * @version	1.0
	 * @since	1.0
	 */
	public function add_template_column( $page_columns ) {
		
		$page_columns['template'] = __( 'Page Template', 'page-template-dashboard' );
		
		return $page_columns;
		
	} // end add_template_column
  
	/*--------------------------------------------*
	 * Actions
	 *--------------------------------------------*/

	/**
	 * Renders the name of the template applied to the current page. Will use 'Default' if no
	 * template is used, but will use the friendly name of the template if one is applied.
	 *
	 * @param	string	$column_name	The name of the column being rendered
	 * @version	1.0
	 * @since	1.0
	 */
	 public function add_template_data( $column_name ) {
		
		// Grab a reference to the post that's currently being rendered
		global $post;
		
		// If we're looking at our custom column, then let's get ready to render some information.
		if( 'template' == $column_name ) {
			
			// First, the get name of the template
			$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
			
			// If the file name is empty or the template file doesn't exist (because, say, meta data is left from a previous theme)...
			if( 0 == strlen( trim( $template_name ) ) || ! file_exists( get_template_directory() . '/' . $template_name ) ) {
			
				// ...then we'll set it as default
				$template_name = __( 'Default', 'page-template-dashboard' );
			
			// Otherwise, let's actually get the friendly name of the file rather than the name of the file itself	
			// by using the WordPress `get_file_description` function
			} else {

				$template_name = get_file_description( get_template_directory() . '/' . $template_name );
				
			} // end if
			
		} // end if

		// Finally, render the template name		
		echo $template_name;
		 
	 } // end add_template_data
  
} // end class

new PageTemplateDashboard();