<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 
$id = get_the_ID();

global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
$cat_slug = '';

foreach ($terms as $term) {
    $product_cat_id = $term->term_id;
    $cat_slug = $term->slug;
    
    if ($term->count <= 4) {
        $cat_slug = $terms[1]->slug;
    }
    $thumbnail_id = get_term_meta( $product_cat_id, 'thumbnail_id', true );
    if ($thumbnail_id != "0") {
        break;
    }
    
}
// get the medium-sized image url
$image = wp_get_attachment_image_src( $thumbnail_id , 'full');
?>

<div id="principal" class="w-100 mb-4">
<!--    <div class="">
        <img class="img-fluid w-100 item" src="<?php //echo $image[0] ?>" alt=""/>
    </div>-->
    <?php // get_template_part( 'parts/logoaccroche' ); ?>
</div>

<div class="container mt-5">
    <?php get_template_part( 'parts/revenir' ); ?>
    <?php echo do_shortcode('[product_page id="' . $id . '"]'); ?>
</div>

<div class="container mt-5 mb-4">
    <h2 class="text-center" data-aos="fade-up">Produits similaires</h2>
    <div class="row carous-promo owl-carousel owl-theme">
        <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 24,
                'orderby'          => 'rand',
                'product_cat' => $cat_slug,
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
            <div class="element-item item promo d-flex align-items-end flex-column mb-1 mt-5 ">
                <div class="p-2 d-flex align-items-center justify-content-center border w-100 div-promo">
                    <img class="img-fluid"  src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" />
                    <?php if ($product->is_on_sale()): 
                            ?>
                            <img class="img-fluid img-promo"  src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/icon_promo.webp" alt="" />
                        <?php endif; ?>
                </div>
                <div class="product-det w-100 d-flex align-items-start flex-column">
                    <div class="p-2 w-100"><a href="<?php echo get_permalink(); ?>"  class="row mb-1 pl-3 title-produits text-center">
                        <strong><?php echo get_the_title(); ?></strong>
                    </a></div>
                    <div class="p-2 text-center w-100 reference-produit"><span><?php echo $product->get_sku(); ?></span></div>
                    <div class="price-woo mt-auto p-2 text-center w-100">
                        <?php if ($product->get_regular_price()): ?>
                            <?php if ($product->get_regular_price() > 1):
                                if ($product->is_on_sale()): ?>   
                                    <div class="promo_prix"><del><?php echo number_format( $product->get_regular_price(), 0, ',', ' '); ?></del> Ar ttc</div>
                                <?php endif; ?>
                                
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

<?php get_footer(); ?>
