<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <!--<title><?php echo get_the_title(); ?></title>-->
    <?php wp_head(); ?>
    
    <meta name="google-site-verification" content="K6UBfl8ni1xmLQcqsot02xH4zUbjvUL6vbVvElyfrFs" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory'); ?>/assets/img/image-nav-sidef.webp">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <meta name="image" property="og:image" content="https://sidef.mg/wp-content/uploads/2021/09/sidef-logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }

        a:hover {
            color: #d9423d;
        }
        #ajaxsearchlite1 .probox .proinput input, div.asl_w .probox .proinput input, #ajaxsearchlite1 .probox .proinput input::placeholder, div.asl_w .probox .proinput input::placeholder {
            color: #262626 !important;
            opacity: 1 !important;
          }
          .devis + .product_type_simple {
  display: none;
}
.modal-content .close {
            color: #e51f49;
            
        }
    </style>
</head>

<body <?php body_class(); ?> >
    <nav class="navbar fixed-top navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand d-lg-none" href="/">
                <img id="logoSidef_sm" data-animate="tada animated" src="<?php echo get_field('logo', 'option')['url']; ?>" alt="<?php echo get_field('logo', 'option')['alt']; ?>">
            </a>
            
            <div class="navbar-brand d-lg-none navbar-sm">
                <a class="nav-link cart-customlocation " href="<?php echo wc_get_cart_url(); ?>" title="Votre panier" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="fa-solid fa-cart-shopping cart-lg-2 menu-cart"></i>
                </a>
                <a class="nav-link" href="<?php echo wc_get_cart_url(); ?>">
                    <i class="fa-brands fa-cc-visa" title="VISA" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                            <i class="fa-brands fa-cc-mastercard" title="MASTERCARD" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                      
<!--                      <i class="fa-brands fa-cc-visa" title="VISA" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                      <i class="fa-brands fa-cc-mastercard" title="MASTERCARD" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>-->
                </a>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav mx-auto">
                    <?php 
                        $menu_name = 'principal';
                        $menus = wp_get_nav_menu_items( $menu_name, array() );
                        foreach($menus as $menu):
                            if ($menu->{'title'} == 'image'):
                            ?>
                        <a class="img-head navbar-brand d-none d-lg-block" href="/">
                            <img id="logoSidef-head" class="animate__animated" src="<?php echo get_field('logo', 'option')['url']; ?>" alt="<?php echo get_field('logo', 'option')['alt']; ?>">
                            <img id="logoSidef" class="animate__animated" src="https://sidef.mg/wp-content/uploads/2022/10/lucas_100-x-100-px.png" alt="<?php echo get_field('logo', 'option')['alt']; ?>">
                            
                        </a>
                    <?php 
                    elseif($menu->{'title'} == 'electromenager'): ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ÉLECTROMÉNAGER
                        </a> 
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php 
                            $menu_name = 'electromenager';
                            $menus = wp_get_nav_menu_items( $menu_name, array() );
                            foreach($menus as $menu):
                                $child_icon = get_field( 'icon_rouge', 'product_cat_'. $menu->{'object_id'})["url"];
                                ?>
                                <li>
                                    <a class="dropdown-item <?php if ($menu->{'object_id'} == get_queried_object_id()): ?>active<?php endif; ?>" href="<?php echo $menu->{'url'}; ?>">
                                        <img class="img-fluid col-2" src="<?php echo $child_icon; ?>" />
                                        <span class="col-10 border-start-menu ps-2 pe-2"><?php echo $menu->{'title'}; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php 
                    else: 
                        $cut = explode("//",$menu->{'url'});
                        $cutFinal = "#" . explode("%",$cut[1])[0];
                        if (get_queried_object_id() != 5 ) {
                            $cutFinal = "/#" . trim($cut[1]);
                        }
                        ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu->{'object_id'} == get_queried_object_id()): ?>active<?php endif; ?>" aria-current="page" href="<?php if ($menu->{'type_label'} == "Page" || $menu->{'type_label'} == "Catégorie"): echo $menu->{'url'}; else: echo $cutFinal; endif; ?>"><?php echo $menu->{'title'}; ?></a>
                    </li>
                    <?php 
                    endif;
                    endforeach; ?>
                    
                    <li class="nav-item d-none d-lg-block d-md-none cart-lg">
                        <a class="d-inline nav-link cart-customlocation " href="<?php echo wc_get_cart_url(); ?>" items="" title="Votre panier" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <i class="fa-solid fa-cart-shopping cart-lg-1 menu-cart"></i>
                        </a>
                        <a class="d-inline nav-link" href="#">
                            <img src="https://sidef.mg/wp-content/uploads/2025/01/mvola-1.png" 
	style="vertical-align: sub; margin-right: 3px;" title="MVola" data-bs-toggle="tooltip" data-bs-placement="bottom"/>
                            <i class="fa-brands fa-cc-visa" title="VISA" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                            <i class="fa-brands fa-cc-mastercard" title="MASTERCARD" data-bs-toggle="tooltip" data-bs-placement="bottom"></i>
                            <!--  <span class="">ou Payez à la livraison</span>-->
                            
                        </a>
                    </li>
                    
<!--                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" title="Mon compte" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>-->
                </ul>
            </div>
        </div>
    </nav>
    
    <div style="min-height: 100%; background: url('<?php the_field('background_body', 'option'); ?>') repeat-y center center; 
  -webkit-background-size: auto;
  -moz-background-size: auto;
  -o-background-size: auto;
  background-size: auto;">
    
    <?php if( have_rows('carroussel') ): 
        while( have_rows('carroussel') ): the_row();
    $galleries = get_sub_field('gallery');
    if ($galleries != false):
        
        ?>
    <div id="principal" class="w-100 mb-4">
        <div class="<?php if (count($galleries) > 1): ?>carous owl-carousel owl-theme<?php endif;?>">
            <?php
            foreach ($galleries as $gallery): ?>
                    <img class="img-fluid w-100 item" src="<?php echo $gallery['url']; ?>" alt="<?php echo $gallery['alt']; ?>"/>
            <?php endforeach;  ?>
        </div>
        <?php get_template_part( 'parts/logoaccroche' ); ?>
    </div>
     <?php else: ?>
    <div id="principal" class="w-100 mb-4">
        <div class="">
            <img class="img-fluid w-100 item" src="https://sidef.mg/wp-content/uploads/2022/09/accueil-generique.webp" alt="page sidef Site marchand"/>
        </div>
        <?php get_template_part( 'parts/logoaccroche' ); ?>
    </div>
    <?php endif; endwhile; endif; ?>

