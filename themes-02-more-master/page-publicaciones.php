<?php 
/**
 * Template Name: Page Publicaciones
 * Template Post Type: page
*/
get_header();?>


    <!--Section-1-->
    <section class="section-1">
        <?php 

            $args = array(
                    'post_type'      => 'post',
                    'category_name'  => 'slider',
                    'posts_per_page' =>  1,
                    'orderby'        => 'title',
                    'order'          => 'DEC'
            );

            $the_query  = new WP_Query($args);
            $custom_ingresarurl = get_post_meta( $post->ID, 'custom_ingresarurl', true );
            if (have_posts()) {

                while ($the_query->have_posts()):$the_query->the_post(); {

                echo '<div class="jumbotron d-flex align-items-center" style="background-image: url('.esc_html( get_post_meta( $post->ID, 'custom_ingresarurl', true )).');height: 250px">';
                echo '<div class="gradient"></div>';
                echo '<div class="container-fluid content">';
                echo '<h1 data-aos="fade-up" data-aos-delay="100">'.get_the_title().'</h1>';
                echo '<h4 data-aos="fade-up" data-aos-delay="500">'.get_the_excerpt().'</h4>';
                echo '</div>'; 
                echo '</div>';

                }
                endwhile;
                wp_reset_postdata();
            }else{
                echo _en('Lo sentimos no existe publicación');
            }
        ?>
    </section>
    <!--Section-2-->


    <!-- blog-single Section Start -->
    <div id="blog-single">
        <div class="container">

<form role="form" action="<?php echo site_url()?>/wp-admin/admin-ajax.php" method="POST" id="filter">

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?php 
                $args = array(
                    'show_option_none' => __( 'Tipo', 'textdomain' ),
                    'show_count'       => 0,
                    'orderby'          => 'name',
                    'echo'             => 0,
                    'hide_empty'       => 0,
                    'exclude'          => '',
                    'include'          => '',
                );
                $select                = wp_dropdown_categories( $args );
                $replace               = "<select id='tipoPublicacion' name='categoryfilter' class='form-control is-invalid'>"; 
                $select                = preg_replace( '#<select([^>]*)>#', $replace, $select );
                echo $select;
             ?>
        </div>

        <div class="col-md-4 mb-3">
            <select id="areaPublicacion" name="slugfilter_area" class="form-control is-invalid">
            <option value="-1" selected="">Área</option>
                <?php
                   $tax_terms = get_terms('area', array('hide_empty' => '0'));  
                   foreach ( $tax_terms as $tax_term ):  
                      echo '<option value="'.$tax_term->slug.'">'.$tax_term->name.'</option>';   
                   endforeach;
                ?>
            </select> 
        </div>
        
        <div class="col-md-4 mb-3">
            <select id="autorPublicacion" name="slugfilter_autor" class="form-control is-invalid">
            <option value="-1" selected="">Áutor</option>
                <?php
                   $tax_terms = get_terms('autor', array('hide_empty' => '0'));  
                   foreach ( $tax_terms as $tax_term ):  
                      echo '<option value="'.$tax_term->slug.'">'.$tax_term->name.'</option>';   
                   endforeach;
                ?>
            </select> 
        </div>

        <div class="col-md-12 mb-3">
            <input id="textPublicacion" class="form-control is-invalid" type="text" name="slugfilter_busqueda" placeholder="Ingresar palabra"/> 
        </div>
    </div>

    <div class="text-center mb-3">
         <button class="btn btn-danger my-2"><i class="fas fa-search mr-2"></i>Buscar</button>
         <input type="hidden" name="action" value="myfilteruno"> 
     </div>


</form>

<section id="response">


</section>

</div>
</div>
    <!-- Blog_single Section End -->

<?php get_footer() ?>