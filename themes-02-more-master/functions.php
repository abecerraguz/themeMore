<?php 

function cargar_estilos() {

        wp_register_style('bootstrap', get_theme_file_uri() . '/css/bootstrap.css', null, null, null);
        wp_register_style('font-awesome', get_theme_file_uri() . '/css/all.min.css', null, null, null);
        wp_register_style('ekko-lightbox', get_theme_file_uri() . '/css/ekko-lightbox.css', null, null, null);
        wp_register_style('animate', get_theme_file_uri() . '/css/animate.css', null, null, null);
        wp_register_style('datatable', get_theme_file_uri() . '/css/datatables.min.css', null, null, null);
        wp_register_style('myStyle', get_theme_file_uri() . '/css/main.css', null, null, null);

        wp_enqueue_style('bootstrap');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('ekko-lightbox');
        wp_enqueue_style('animate');
        wp_enqueue_style('datatable');
        wp_enqueue_style('myStyle');

}

add_action( 'wp_enqueue_scripts', 'cargar_estilos' );

function cargar_scripts() {

        wp_register_script('jQuery3_3_1', get_bloginfo('template_directory') . '/js/jquery-3.3.1.js', null, null, true);
        wp_register_script('popper', get_bloginfo('template_directory') . '/js/popper.min.js', null, null, true);
        wp_register_script('bootstrapJs', get_bloginfo('template_directory') . '/js/bootstrap.min.js', null, null, true);
        wp_register_script('ekko-lightbox', get_bloginfo('template_directory') . '/js/ekko-lightbox.js', null, null, true);
        wp_register_script('animate', get_bloginfo('template_directory') . '/js/animate.js', null, null, true);
        wp_register_script('datatableJs', get_bloginfo('template_directory') . '/js/datatables.min.js', null, null, true);
        wp_register_script('myjs', get_bloginfo('template_directory') . '/js/custom.js', null, null, true);
        
        wp_enqueue_script('jQuery3_3_1');
        wp_enqueue_script('popper');
        wp_enqueue_script('bootstrapJs');
        wp_enqueue_script('ekko-lightbox');
        wp_enqueue_script('animate');
        wp_enqueue_script('datatableJs');
        wp_enqueue_script('myjs');
       
}

add_action( 'wp_enqueue_scripts', 'cargar_scripts' );



class Custom_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }

    }

    public function init_metabox() {

        add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
        add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

    }

    public function add_metabox() {

        add_meta_box(
            'datos',
            __( 'Datos iconos', 'text_domain' ),
            array( $this, 'render_metabox' ),
            'post',
            'advanced',
            'default'
        );

    }

    public function render_metabox( $post ) {

        // Retrieve an existing value from the database.
        $custom_ingresarurl = get_post_meta( $post->ID, 'custom_ingresarurl', true );
        $custom_selecticonos = get_post_meta( $post->ID, 'custom_selecticonos', true );

        // Set default values.
        if( empty( $custom_ingresarurl ) ) $custom_ingresarurl = '';
        if( empty( $custom_selecticonos ) ) $custom_selecticonos = '';

        // Form fields.
        echo '<table class="form-table">';

        echo '  <tr>';
        echo '      <th><label for="custom_ingresarurl" class="custom_ingresarurl_label">' . __( 'Ingresar url', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="custom_ingresarurl" name="custom_ingresarurl" class="custom_ingresarurl_field" placeholder="' . esc_attr__( 'Ingresar url', 'text_domain' ) . '" value="' . esc_attr( $custom_ingresarurl ) . '">';
        echo '          <p class="description">' . __( 'Ingresar url', 'text_domain' ) . '</p>';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="custom_selecticonos" class="custom_selecticonos_label">' . __( 'Seleccionar Iconos servicios', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <select id="custom_selecticonos" name="custom_selecticonos" class="custom_selecticonos_field">';
        echo '          <option value="fa-desktop" ' . selected( $custom_selecticonos, 'fa-desktop', false ) . '> ' . __( 'Computador', 'text_domain' ) . '</option>';
        echo '          <option value="fa-code" ' . selected( $custom_selecticonos, 'fa-code', false ) . '> ' . __( 'Codigo', 'text_domain' ) . '</option>';
        echo '          <option value="fa-comments" ' . selected( $custom_selecticonos, 'fa-comments', false ) . '> ' . __( 'Comentarios', 'text_domain' ) . '</option>';
        echo '          <option value="custom_" ' . selected( $custom_selecticonos, 'custom_', false ) . '> ' . __( '', 'text_domain' ) . '</option>';
        echo '          </select>';
        echo '          <p class="description">' . __( 'Seleccionar Iconos servicios', 'text_domain' ) . '</p>';
        echo '      </td>';
        echo '  </tr>';

        echo '</table>';

    }

    public function save_metabox( $post_id, $post ) {

        // Sanitize user input.
        $custom_new_ingresarurl = isset( $_POST[ 'custom_ingresarurl' ] ) ? sanitize_text_field( $_POST[ 'custom_ingresarurl' ] ) : '';
        $custom_new_selecticonos = isset( $_POST[ 'custom_selecticonos' ] ) ? $_POST[ 'custom_selecticonos' ] : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'custom_ingresarurl', $custom_new_ingresarurl );
        update_post_meta( $post_id, 'custom_selecticonos', $custom_new_selecticonos );

    }

}

new Custom_Meta_Box;




add_theme_support('post-thumbnails');


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


// Register Custom Taxonomy
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

// Register Custom Taxonomy
function _autor_custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Áutor', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Áutor', 'text_domain' ),
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
    register_taxonomy( 'autor', array( 'publicacion' ), $args );

}
add_action( 'init', '_autor_custom_taxonomy', 0 );

// Register Custom Taxonomy
function _busqueda_custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Criterios de busqueda', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Criterios de busqueda', 'text_domain' ),
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
    register_taxonomy( 'busqueda', array( 'publicacion' ), $args );

}
add_action( 'init', '_busqueda_custom_taxonomy', 0 );







add_action( 'init', 'my_ajax_publicacionesPublicas');

function my_ajax_publicacionesPublicas() {
   add_action('wp_ajax_myfilteruno', 'publicacionesPublicas'); 
   add_action('wp_ajax_nopriv_myfilteruno', 'publicacionesPublicas');
}

function publicacionesPublicas(){
    
    $args = array(
        'post_type'         => 'publicacion',
        'orderby'           => 'date', 
        'category_name'     => '',
        'posts_per_page'    => -1
    );
    

    // if( isset( $_POST['categoryfilter']) && ( $_POST['categoryfilter'] != '-1') || isset( $_POST['slugfilter_area']) && ( $_POST['slugfilter_area'] != '-1')  || isset( $_POST['slugfilter_autor']) && ( $_POST['slugfilter_autor'] != '-1') || isset( $_POST['slugfilter_busqueda']) && ( $_POST['slugfilter_busqueda'] != '-1'))
    //     $args['tax_query'] = array(
    //         'relation' => 'OR',
    //         array(
    //             'taxonomy'  => 'category',
    //             'terms'     => $_POST['categoryfilter'],
    //             'compare'   => '=' 
    //         ),
    //         array(
    //             'taxonomy'  => 'area',
    //             'terms'     => $_POST['slugfilter_area'],
    //             'field'     => 'slug',
    //             'compare'   => '='  
    //         ),
    //         array(
    //             'taxonomy'  => 'autor',
    //             'terms'     => $_POST['slugfilter_autor'],
    //             'field'     => 'slug',
    //             'compare'   => '='  
    //         ),
    //         array(
    //             'taxonomy'  => 'busqueda',
    //             'terms'     => $_POST['slugfilter_busqueda'],
    //             'field'     => 'slug',
    //             'compare'   => '='  
    //         )

    // );

    if(isset( $_POST['categoryfilter']) && ($_POST['categoryfilter'] != '-1') && ($_POST['categoryfilter'] != ''))
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy'  => 'category',
                'terms'     => $_POST['categoryfilter'],
                'operator'   => 'IN'  
            )
    );

   if(isset( $_POST['slugfilter_area']) && ($_POST['slugfilter_area'] != '-1') && ($_POST['slugfilter_area'] != ''))
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy'  => 'area',
                'terms'     => $_POST['slugfilter_area'],
                'field'     => 'slug',
                'operator'   => 'IN' 
            )
    );

    if(isset( $_POST['slugfilter_autor']) && ($_POST['slugfilter_autor'] != '-1') && ($_POST['slugfilter_autor'] != ''))
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy'  => 'autor',
                'terms'     => $_POST['slugfilter_autor'],
                'field'     => 'slug',
                'operator'   => 'IN' 
            )
    );

    if(isset( $_POST['slugfilter_busqueda']) && ($_POST['slugfilter_busqueda'] != '-1') && ($_POST['slugfilter_busqueda'] != ''))
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy'  => 'busqueda',
                'terms'     => $_POST['slugfilter_busqueda'],
                'field'     => 'slug',
                'operator'   => 'IN' 
            )
    );


    $query      = new WP_Query( $args );
    echo '<table id="_buscarDatosPublicacion" class="table table-striped table-bordered" style="width:100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Título</th>';
    echo '<th>Fecha</th>';
    echo '<th>Tipo</th>';
    echo '<th>Áreas</th>';
    echo '<th>Autores</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    if( $query->have_posts() ) :
        while( $query->have_posts() ): $query->the_post();
            $categories = get_the_category();
            $areas      = get_the_terms( $post->ID,'area');
            $autores    = get_the_terms( $post->ID,'autor');
            echo '<tr>';
            echo '<td>'.$query->post->post_title.'</td>';
            echo '<td>'.get_the_date('j F, Y').'</td>';
            echo '<td>'.$categories[0]->name.'</td>';
            echo '<td>';
                foreach ( $areas as $area ) {
                    echo $area->name;
                }
            echo '</td>';
            echo '<td>';
                foreach ( $autores as $autor ) {
                    echo $autor->name.'<br>';
                }
            echo '</td>';
            echo '</tr>';
        endwhile;
    echo '</tbody>';
    echo '</table>';
        wp_reset_postdata();
    else :
    echo '<div class="row">';  
    echo '<div class="col-sm-12">';
    echo '<div class="alert alert-secondary text-center my-3">';
    echo '<p class="my-3">No existe información para el período seleccionados</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    endif;
    die();
}


 ?>