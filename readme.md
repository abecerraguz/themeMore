<section>

# Themes Wordpress uso de Post_type, Tax_query, Ajak, Taxonmy

![Landing More Themes](screenshot_landing.png)

Trabajo en desarrollo para `http://www.amtc.cl/`, buscador de inverstigadores.


## REGISTRAR POST_TYPE
~~~html
<?php
	function codex_publicacion() {
    $labels = array(
        'name'               => _x( 'Publicaciones', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Publicación', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Publicaciones', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Publicación', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'publicación', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Publicación', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Publicación', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Publicación', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Publicación', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Publicaciones', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Publicaciones', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Publicaciones:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'publicación' ),
        'capability_type'    => 'page',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','author','thumbnail','excerpt','category'),
        'taxonomies'         => array( 'category' ),
    );



    register_post_type( 'publicacion', $args );
}
add_action( 'init', 'codex_publicacion' );
?>
~~~

## REGISTRAR TAXONOMY A UN POST_TYPE
~~~html
<?php

function _area_custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Área', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Área', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'area', array( 'publicacion' ), $args );

}
add_action( 'init', '_area_custom_taxonomy', 0 );
?>
~~~





</section>
