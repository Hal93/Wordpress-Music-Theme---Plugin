<?php
/*
Plugin Name: MusicMate
Version: 1.0
Author: Dean O Halloran
Description: MusicMate is a plugin designed to help music blog owners sell their products through oscommerce but also create album reviews with specific genres and taxonomies. 

Copyright 2015  Dean O Halloran  (email : dean.ohalloran@mycit.ie)

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

function include_scripts() {
	include('store.html');
}

function register_musicmate_album_review() {
 
    $labels = array(
        'name' => _x( 'Album Reviews', 'album_review' ),
        'add_new' => _x( 'Add New', 'album_review' ),
        'edit_item' => _x( 'Edit Album Review', 'album_review' ),
        'add_new_item' => _x( 'Add New Album Review', 'album_review' ),
        'new_item' => _x( 'New Album Review', 'album_review' ),
        'search_items' => _x( 'Search Album Reviews', 'album_review' ),
        'view_item' => _x( 'View Album Review', 'album_review' ),
        'not_found' => _x( 'No album reviews found', 'album_review' ),
        'menu_name' => _x( 'Album Reviews', 'album_review' ),
        'not_found_in_trash' => _x( 'No album reviews in bin', 'album_review' ),
        'parent_item_colon' => _x( 'Parent Album Review:', 'album_review' ),
        'singular_name' => _x( 'Album Review', 'album_review' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Search Album Reviews using genres',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'genres' ),
        'public' => true,
        'show_in_menu' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-audio',
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'can_export' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post'
    );
 
    register_post_type( 'music_review', $args );
}
 

function register_genre_taxonomies() {
    register_taxonomy(
        'genres',
        'album_review',
        array(
            'hierarchical' => true,
            'label' => 'Genres',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => false
            )
        )
    );
}



function init_album_review_pages()
  {
   //post status and options
    $reviewpost = array(
          'comment_status' => 'open',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'album_review',
          'post_status' => 'publish' ,
          'post_title' => 'Album Reviews',
          'post_type' => 'page',
    );

    //insert page and save the id
    $newreview = wp_insert_post( $reviewpost, false );
    //save the id in the database
    update_option( 'newpage', $newreview);
  }



function store_admin_page() {
    include('musicmate_form.php');
}

function musicmate_add_menu_page() {
 	add_menu_page("Store Admin", "Store Admin", 1, "Store_Admin", "store_admin_page");
}
 


function musicmate_get_store_products($product_cnt=1) {
    //Connect to the OSCommerce database
    $storedatabase = new wpdb(get_option('oscimp_dbuser'),get_option('oscimp_dbpwd'), get_option('oscimp_dbname'), get_option('oscimp_dbhost'));
 
    $prodVal = '';
    for ($i=0; $i<$product_cnt; $i++) {
        //Get a random product
        $product_count = 0;
        while ($product_count == 0) {
            $product_id = rand(0,30);
            $product_count = $storedatabase->get_var("SELECT COUNT(*) FROM products WHERE products_id=$product_id AND products_status=1");
        }
         
        //Get product image, name and URL
        $product_image = $storedatabase->get_var("SELECT products_image FROM products WHERE products_id=$product_id");
        $product_name = $storedatabase->get_var("SELECT products_name FROM products_description WHERE products_id=$product_id");
        $store_url = get_option('oscimp_store_url');
        $image_folder = get_option('oscimp_prod_img_folder');
 
        //Build the HTML code
        $prodVal .= '<div class="store_product">';
        $prodVal .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '"><img src="' . $image_folder . $product_image . '" /></a><br />';
        $prodVal .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '">' . $product_name . '</a>';
        $prodVal .= '</div>';
 
    }
    return $prodVal;
}


// Run Hooks
add_action( 'wp_enqueue_scripts', 'include_scripts' );
register_activation_hook( __FILE__, 'init_album_review_pages');
add_action('admin_menu', 'musicmate_add_menu_page');
add_action( 'init', 'register_genre_taxonomies');
add_action( 'init', 'register_musicmate_album_review' );

