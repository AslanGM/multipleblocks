<?php
/**
 * Plugin Name:       Multiple Blocks
 * Description:       Example static block scaffolded with Create Block tool.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       multipleblocks
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

//add custom block category
function multipleblocks_add_custom_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'multiple-category',
				'title' => __('Multiple Blocks Elements', 'multipleblocks'),
			)
		)
	);
}

//support older versions
if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
	add_filter( 'block_categories_all', 'multipleblocks_add_custom_category', 10, 2 );
} else {
	add_filter( 'block_categories', 'multipleblocks_add_custom_category', 10, 2 );
}

function multipleblocks_create_block_init() {
	$blocks = array(
		'blockone/',
		'blocktwo/',
	);
	foreach( $blocks as $block ) {
		register_block_type( plugin_dir_path( __FILE__ ) . 'build/' . $block );
	}
}
add_action( 'init', 'multipleblocks_create_block_init' );
