<?php get_header() ?>
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

                    echo '<div class="jumbotron d-flex align-items-center" style="background-image: url('.$custom_ingresarurl.');">';
                    echo '<div class="gradient"></div>';
                    echo '<div class="container-fluid content">';
                    echo '<h1 data-aos="fade-up" data-aos-delay="100">'.get_the_title().'</h1>';
                    echo '<h4 data-aos="fade-up" data-aos-delay="500">'.get_the_excerpt().'</h4>';
                    echo '<p data-aos="fade-up" data-aos-delay="700"><a href="'.get_the_permalink().'" class="btn btn-success">Iniciar</a></p>';
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
    <section class="section-2">
        <div class="container">
            <h1 class="text-center mb-5" data-aos="fade-left" data-aos-delay="300"><?php echo get_the_title(13);?></h1>
            <div class="row">

                <?php 
                    $argsServicios = array(
                        'post_type'     => 'post',
                        'post_per_page' => 3,
                        'category_name' => 'servicios',
                        'orderby'       => 'title',
                        'order'         => 'ASC'
                    );

                    $the_queryServicios = new WP_Query($argsServicios);
                    $url                = get_bloginfo('template_url');
                    $custom_selecticonos = get_post_meta( $post->ID, 'custom_selecticonos', true );

                    // var_dump($custom_selecticonos);

                    if ($the_queryServicios->have_posts()) {

                        while ($the_queryServicios->have_posts()):$the_queryServicios->the_post(); {

                            //echo ''.esc_html( get_post_meta( $post->ID, 'custom_selecticonos', true )).'';

                            echo '<div class="col-lg-4 col-sm-12 col-12 box-1">';
                            echo '<div class="row box" data-aos="fade-left" data-aos-delay="300">';
                            echo '<div class="col-lg-2 col-sm-12">';
                            echo '<i class="fa '.esc_html( get_post_meta( $post->ID, 'custom_selecticonos', true )).'" aria-hidden="true"></i>';
                            echo '</div>';
                            echo '<div class="col-lg-10 col-sm-12">';
                            echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
                            echo '<p>'.get_the_excerpt().'/p>';
                            echo '<p><a href="pagina-servicios-diseno.html"><img src="'.$url.'/images/plus.png" alt="plus"></a></p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                        }
                    endwhile;
                    wp_reset_postdata();

                    }else{
                        echo _en('Lo sentimos no existe publicación');
                    }
                ?>

            </div>
        </div>
    </section>
    <hr>
    <section class="section-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12" data-aos="fade-left" data-aos-delay="300">
                    <h1 class="text-center mb-5" data-aos="fade-left" data-aos-delay="300"><?php echo get_the_title(65);?></h1>

                    <?php 
                        $argsActualidad     = array(
                            'post_type'     => 'post',
                            'category_name' => 'actualidad',
                            'post_per_page' =>  3,
                            'orderby'       => 'title',
                            'order'         => 'ASC'
                        );
                        $the_queryActualidad = new WP_Query($argsActualidad );
                        if ($the_queryActualidad->have_posts()) {
                            while ($the_queryActualidad->have_posts()):$the_queryActualidad->the_post(); {

                                echo '<div class="row" >';
                                echo '<div class="col-sm-6 col-12 box-2">';
                                echo '<figure class="figure">';
                                echo '<a href="'.get_the_permalink().'">';
                                echo the_post_thumbnail('full','class=figure-img img-fluid');
                                echo '</a>';
                                echo '</figure>';
                                echo '</div>';
                                echo '<div class="col-sm-6 col-12 box-3">';
                                echo '<h4><a href="'.get_the_permalink().'">'.get_the_title().'/a></h4>';
                                echo '<h5>'.get_the_excerpt().'</h5>';
                                echo '<a href="'.get_the_permalink().'" class="btn btn-success">+ saber más</a>';
                                echo '</div>';
                                echo '</div>';

                            }
                        endwhile;
                        wp_reset_postdata();
                        }else{
                            echo _e( '<h3>Lo sentimos no existe publicación</h3>' );
                        }
                     ?>
                </div>
            </div>
        </div>
        <!--container-->
    </section>
<?php get_footer();?>