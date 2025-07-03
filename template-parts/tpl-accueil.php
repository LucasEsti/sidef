<?php

/**
 * Template Name: Accueil
 */
get_header(); ?>
    
    <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'orderby'          => 'rand',
            //not in catégorie tohiba
            'tax_query'      => array( array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => array(54), // Term ids to be excluded
                'operator' => 'NOT IN' // Excluding terms
            ) ),
            'meta_query'        => WC()->query->get_meta_query(),
            'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
        );
        $loop = new WP_Query( $args );
        if( $loop->have_posts() ) : ?>
    <div class="container text-center mb-5">
        <h3 class="" >
            Profitez de nos articles en <br>
        </h3>
        <h3 class="animate__animated animate__pulse animate__delay-1s animate__faster animate__infinite" >
            <span class="promo">PROMOTION</span>
        </h3>
        <div class="row carous-promo owl-carousel owl-theme">
            <?php while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                
                ?>
            <div class="element-item item promo d-flex align-items-end flex-column mb-1 mt-5 ">
                <div class="p-2 d-flex align-items-center justify-content-center border w-100 div-promo">
                    <img class="img-fluid" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" />
                    <img class="img-fluid img-promo" src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/icon_promo.webp" alt="" />
                </div>
                <div class="product-det w-100 d-flex align-items-start flex-column">
                    <div class="p-2 w-100">
                        <a href="<?php echo get_permalink(); ?>" class="row mb-1 pl-3 title-produits text-center">
                            <strong><?php echo get_the_title(); ?></strong>
                        </a>
                    </div>
                    <div class="p-1 text-center w-100 reference-produit"><span><?php echo $product->get_sku(); ?></span></div>
                    <div class="price-woo mt-auto p-1 text-center w-100">
                        <?php if ($product->get_regular_price()): 
                            ?>
                                <div class="promo_prix"><del><?php echo number_format( $product->get_regular_price(), 0, ',', ' '); ?></del> Ar ttc</div>
                                <span><strong><?php echo number_format( $product->get_price(), 0, ',', ' '); ?></strong> Ar ttc 
                                    
                                </span>
                            <?php else: ?>
                            <?php echo wc_get_product(get_the_ID())->get_price_html(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-auto p-2 w-100 prod_btn text-center">
                    <?php if ($product->get_regular_price()): ?>
                                <a href="<?php echo $product->add_to_cart_url() ?>" 
                                value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                class="ajax_add_to_cart add_to_cart_button"
                                data-product_id="<?php echo get_the_ID(); ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"><span class="col-11 w-10">
                                     <i class="fa-solid fa-cart-shopping "></i></span> 
                             </a>
                            <?php else: ?>
                                <a href="<?php echo get_permalink(); ?>" >
                                    Détails
                                </a>
                            <?php endif; ?>
                </div>
            </div>
            <?php 
            endwhile;
            wp_reset_query();?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Modal image_popup-->
<?php if( get_field('image_popup', 'option') ): ?>
                     
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close  btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="<?php the_field('image_popup', 'option'); ?>" class="img-fluid"/>
      </div>
      <div class="modal-footer">
          
      </div>
    </div>
  </div>
</div>
                        <?php endif; ?>

    <div class="container mt-3 mb-3">
        <div class="row">
            <img class="img-fluid" src="<?php echo get_field('animation_livraison', 'option')['url']; ?>">
        </div>
    </div>

    <div class="container text-center mb-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-6 col-md-11 col-11" >
                    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                </div>
            </div>
    </div>


    <?php if( have_rows('description') ):
                while( have_rows('description') ): the_row(); ?>
    <section class="section mb-5" id="description" >
        <div class="container">
            <div class="row pl-2">
                <div class="d-flex align-items-center col-lg-4 col-md-4 col-12 mb-2">
                    <img src="<?php echo get_sub_field('icon')['url']; ?>" class="rounded img-fluid d-block mx-auto" alt="<?php echo get_sub_field('icon')['alt']; ?>">
                </div>
                <div class="container col-lg-8 col-md-8 col-12">
                    <div class="row mb-1 pl-4 w-100">
                        <h2 class="titre_categorie"><?php echo get_sub_field('titre_categorie'); ?></h2>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <?php foreach(get_sub_field('categorie_repeteur') as $categorie_repeteur): ?>
                        <div class="col-lg-4 col-md-6 col-6 mb-3">
                            <a href="<?php echo get_term_link( $categorie_repeteur['lien'][0], 'product_cat' ); ?>" class="h-100 cat-list d-flex align-items-center flex-column  p-3 border">
                            <div class="p-2 d-flex align-items-center justify-content-center cat-img">
                                <img class="img-fluid w-50" src="<?php echo $categorie_repeteur['icon']["url"]; ?>" alt="<?php echo $categorie_repeteur['icon']["alt"]; ?>">
                            </div>
                            <div class="mt-auto text-center">
                                <h4 ><?php echo $categorie_repeteur['titre']; ?></h4>
                            </div>
                        </a>
                        </div>
                        
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <?php
            endwhile;
        endif; ?>

    <?php if( have_rows('livraison') ):
            while( have_rows('livraison') ): the_row(); 
    
    if (get_sub_field('type')): ?>
    <div class="container mb-3 mt-3">
        <div class="row carous-livraison owl-carousel owl-theme" >
            <?php foreach(get_sub_field('type') as $type): ?>
            <div class="item d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-4 d-flex align-items-center justify-content-center"><?php echo $type['icon']; ?></div>
                    <div class="col-8">
                        <span class="bold"><?php echo $type['titre']; ?></span>
                        <span class="desc"><?php echo $type['desc']; ?></span>
                    </div>
                </div>
                
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    endif;
            endwhile;
        endif; ?>

    <div class="container mb-3">
        <div class="row ">
            <h3 class="text-center" >Nos <span class="selection">sélections</span> de produits</h3>
        </div>
        <div class="row">
            <?php
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 12,
                    'orderby'          => 'rand',
                    //not in catégorie tohiba
                    'tax_query'      => array( array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => array(54), // Term ids to be excluded
                        'operator' => 'NOT IN' // Excluding terms
                    ) ),
                );
                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                    ?>
            
            <div class="element-item d-flex align-items-end flex-column col-lg-2 col-md-3 col-6 mb-1 mt-5 ">
                <div class="p-2 d-flex align-items-center justify-content-center border w-100 div-promo">
                    <img class="img-fluid" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="<?php echo get_post_meta( $product->get_image_id() , '_wp_attachment_image_alt', TRUE); ?>" />
                    <?php if ($product->is_on_sale()): 
                            ?>
                            <img class="img-fluid img-promo" src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/icon_promo.webp" alt="" />
                        <?php endif; ?>
                    
                </div>
                <div class="product-det w-100 d-flex align-items-start flex-column">
                    <div class="p-2 w-100"><a href="<?php echo get_permalink(); ?>"  class="row mb-1 pl-3 title-produits text-center">
                        <strong><?php echo get_the_title(); ?></strong>
                    </a></div>
                    <div class="p-2 text-center w-100 reference-produit" ><span><?php echo $product->get_sku(); ?></span></div>
                    <div class="price-woo mt-auto p-2 text-center w-100">
                        <?php if ($product->get_regular_price()): ?>
                            <?php if ($product->get_regular_price() > 1):
                                if ( $product->is_on_sale() )  { ?>   
                                    <div class="promo_prix"><del><?php echo number_format( $product->get_regular_price(), 0, ',', ' '); ?></del> Ar ttc</div>
                                <?php } ?>
                                
                                <span><strong><?php echo number_format( $product->get_price(), 0, ',', ' '); ?></strong> Ar ttc
                                
                                </span>
                            <?php else: ?>
                                Sur devis
                            <?php endif; ?>
                        <?php else: ?>
                            <?php
                            $product = wc_get_product(get_the_ID());
                            $current_products = $product->get_children();
                            
                            if ($current_products) {
                                $price = get_post_meta($current_products[0], '_price', true);
                                if ($current_products && $price == 1) {
                                    echo "Sur devis";
                                } else {
                                    echo wc_get_product(get_the_ID())->get_price_html(); 
                                }
                            }
                            
                            ?>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <div class="mt-auto p-2 w-100 prod_btn text-center">
                    <?php if ($product->get_regular_price()): ?>
                        <?php if ($product->get_regular_price() > 1): ?>
                                <a href="<?php echo $product->add_to_cart_url() ?>" 
                                value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                class="ajax_add_to_cart add_to_cart_button"
                                data-product_id="<?php echo get_the_ID(); ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"><span class="col-11 w-10">
                                     <i class="fa-solid fa-cart-shopping "></i></span> 
                             </a>
                            <?php else: ?>
                                <a href="<?php echo get_permalink(); ?>" >
                                    Détails
                                </a>
                            <?php endif; ?>
                        
                    <?php else: ?>
                        <a href="<?php echo get_permalink(); ?>" >
                            Détails
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
            endwhile;
            wp_reset_query();?>
        </div>
    </div>
<?php if( have_rows('description') ):
                while( have_rows('description') ): the_row(); ?>
    <section class="section mb-5" >
        <div class="container">
            <div class="row mb-5">
                <?php get_template_part( 'parts/toshiba' ); ?>
                
                <div class="row mb-3 pl-4 w-100">
                    <div class="col-lg-6 col-md-12 col-12 col-xs-12">
                        <div class="row mb-0" >
                            <p><?php echo get_sub_field('systeme_impression')['description_1']; ?></p>
                        </div>
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <?php foreach(get_sub_field('systeme_impression')['texte_repetiteur'] as $systeme_impression_repeteur): ?>
                                                <th scope="col" class="systeme_impression_repeteur_titre text-center"><?php echo $systeme_impression_repeteur['titre']; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php foreach(get_sub_field('systeme_impression')['texte_repetiteur'] as $systeme_impression_repeteur): ?>
                                            <td class="systeme_impression_text" > 
                                                > <?php echo $systeme_impression_repeteur['description']; ?>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <?php foreach(get_sub_field('systeme_impression')['texte_repetiteur'] as $systeme_impression_repeteur): ?>
                                                <td class="sys_impr_footer"></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                        </div>
                        <div class="row" >
                            <?php echo get_sub_field('systeme_impression')['description_2']; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12 col-xs-12 d-flex align-items-center justify-content-center" >
                        <img class="img-fluid w-100" src="<?php echo get_sub_field('systeme_impression')['image_toshiba']['url']; ?>" alt="<?php echo get_sub_field('systeme_impression')['image_toshiba']['alt']; ?>">
                    </div>
                </div>
                <div class="site_toshiba d-flex justify-content-center pb-2 pt-2 ">
                    <?php echo get_sub_field('systeme_impression')['site_toshiba']; ?>
                </div>
            </div>
            
        </div>
        </section>
        <?php
            endwhile;
        endif; ?>

<?php if( have_rows('engagement') ):
            while( have_rows('engagement') ): the_row(); ?>
    <section id="engagement" class="section mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center engagements" >
                <div class="row mb-3 ml-5 mr-5">
                    <div class="center-heading" >
                        <h2 class="text-white text-center enga_titre">
                            <em><?php echo get_sub_field('titre'); ?></em>
                        </h2>
                    </div>
                </div>
                <div class="row mb-5" >
                    <div class="row mb-5">
                        <?php 
                        $i = 0;
                        foreach(get_sub_field('engagement_repeteur') as $engagement_repeteur): ?>
                        <div class=" <?php echo $engagement_repeteur['class']; ?>">
                            <div class="<?php echo $engagement_repeteur['class_2']; ?>">
                                <h5 class="detail-eng text-white"><?php echo $engagement_repeteur['titre']; ?></h5>
                            </div>
                            <div class="<?php echo $engagement_repeteur['class_3']; ?>">
                                <ul>
                                    <?php foreach($engagement_repeteur['descritif_repeteur'] as $descritif_repeteur): ?>
                                    <li class="mb-3 mr-5" style="color: white;" >
                                        <img class="img-fluid" src="<?php echo get_sub_field('puce')['url']; ?>" alt="<?php echo get_sub_field('puce')['alt']; ?>">
                                        <?php echo $descritif_repeteur['text']; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php 
                        $i++;
                        endforeach; ?>
                    </div>
                    
                    <div class="row d-flex align-items-center"> 
                        <span style="text-align: center;">
                            <a href="https://sidef.mg/engagement-de-sidef/" style="padding: 5px 8px;color: white;border: white solid 1px;">Nos engagements</a>
                        </span>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endwhile;
    endif; ?>

<?php get_footer(); ?>