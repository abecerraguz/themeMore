<!doctype html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <title><?php bloginfo('name')?></title>
    <meta name="description" content="<?php bloginfo('description');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url')?>">
    <?php wp_head();?>
</head>

<body>
    <header class="header bg">
        <div class="container text-white">
            <div class="row">
                <div class="col-sm-4 col-12 align-self-center box-1 text-center">
                    <a class="navbar-brand" href="index.html"><img src="<?php bloginfo('template_url');?>/images/logo.png" alt="logo"></a>
                </div>
                <div class="col-sm-4 align-self-center text-right ml-md-auto">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <!--/row-->
        </div>
        <!--container-->
    </header>
    <span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
    <nav class="navbar navbar-expand-sm sticky-top navbar-dark">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbar1">
                <?php wp_page_menu(
                    array(

                        'depth' => 0,
                        'sort_column' => 'menu_order, post_title',
                        'menu_class' => 'menu',
                        'include' => ' ',
                        'exclude' => ' ',
                        'echo' => true,
                        'show_home' => true,
                        'link_before' => '',
                        'link_after' => ''
                    )
                )
                ;?>

            </div>
        </div>
        <!--container end-->
    </nav>
<!-- Cierre del header.php -->