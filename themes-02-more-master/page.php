<?php get_header();?>


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

            <?php 
                if (have_posts()) {


                $categories = get_the_category();

                while (have_posts()):the_post(); {
                        echo '<div class="row" data-aos="fade-up" data-aos-duration="700">';
                        echo '<div class="col-sm-12">';
                        echo the_post_thumbnail('full','class=img-thumbnail image');
                        echo '<div class="heading">';
                        echo '<h2>'.get_the_title().'</h2>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="row" data-aos="fade-up" data-aos-duration="700">';
                        echo '<div class="col-sm-12 col-lg-12 box">';

                        echo '<p>'.get_the_content().'</p>';
            
                        echo '</div>';
                        echo '</div>';
                       
                   }
               endwhile;
                }else{
                   echo _en('<h3>Lo sentimos no existe publicación</h3>'); 
                }

             ?>
        </div>
    </div>
    <!-- Blog_single Section End -->

<?php get_footer() ?>