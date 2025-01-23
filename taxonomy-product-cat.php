<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$id = get_the_ID();

global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );

$cate = get_queried_object();
$product_cat_id = $cate->term_id;


$cat_slug = '';


foreach ($terms as $term) {
//    $product_cat_id = $term->term_id;
    $cat_slug = $cate->slug;
    $thumbnail_id = get_term_meta( $product_cat_id, 'thumbnail_id', true );
    if ($thumbnail_id != "0") {
        break;
    }
    
}

// get the medium-sized image url
$image = wp_get_attachment_image_src( $thumbnail_id , 'full');

?>

<div id="principal" class="w-100 mb-4">
    <?php if ($image): ?>
    <div class="">
        <img class="img-fluid w-100 item" src="<?php echo $image[0] ?>" alt=""/>
    </div>
    <?php get_template_part( 'parts/logoaccroche' ); ?>
    <?php endif; ?>
</div>

<div class="container mt-3 mb-3">
    <div class="row">
        <img class="img-fluid" src="<?php echo get_field('animation_livraison', 'option')['url']; ?>">
    </div>
</div>

<?php get_template_part( 'parts/revenir' ); ?>

<div class="container mt-5 mb-4">
    <h1><?php single_term_title() ; ?></h1>
    <div class="row">
    <?php echo term_description() ; ?>
    </div>
    <?php if ($product_cat_id == 54): ?>
    <?php get_template_part( 'parts/toshiba' ); ?>
    <?php else:
            $term_id = (int) $product_cat_id;
            if ( term_exists( $term_id, 'product_cat' ) ) {
                $child_terms_ids = get_term_children( $term_id, 'product_cat' );
                ?>
                <div class="row mt-2 mb-4 d-flex justify-content-lg-between justify-content-md-between justify-content-center"> 
                    <?php foreach ( $child_terms_ids as $child_term_id ) {
                    $child_term = get_term_by( 'term_id', $child_term_id, 'product_cat');
                    $child_name = $child_term->name;
                    $child_icon = get_field( 'icon', 'product_cat_'.$child_term_id)["url"];
                    $child_link = get_term_link( $child_term, 'product_cat');
                    ?>
                    <!--<div class="col-lg-4 col-md-6 col-11 pt-2  pb-2 mb-3 cat-img">-->
                        <a class="col-lg-4 col-md-6 col-11 pt-2  pb-2 mb-3 cat-img" href="<?php echo $child_link; ?>">
                            <div class="cat-taxo p-2 row m-1 d-flex align-items-center">
                                <img class="border-end-cat img-fluid col-2" src="<?php echo $child_icon; ?>" alt="" />
                                <span class="col-10 ps-2"><?php echo $child_name; ?></span>
                            </div>
                        </a>
                    <!--</div>-->
                    
                    <?php } ?>
                </div>
    <?php  }
    endif; ?>
    <div class="row mb-5">
        <?php if (have_posts()) : while (have_posts()) : the_post(); global $product; ?>
            <?php if ($product_cat_id != 54): ?>
            <div class="element-item d-flex align-items-end flex-column col-lg-2 col-md-3 col-6 mb-1 mt-5">
                <div class="p-2 d-flex align-items-center justify-content-center border w-100 div-promo">
                    <img class="img-fluid" data-aos="fade-up-right" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" />
                    <?php if ($product->is_on_sale()): 
                        ?>
                        <img class="img-fluid img-promo" data-aos="fade-down-right" src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/icon_promo.webp" alt="" />
                    <?php endif; ?>
                </div>
                <div class="product-det w-100 d-flex align-items-start flex-column">
                    <div class="p-2 w-100"><a href="<?php echo get_permalink(); ?>" data-aos="flip-left" class="row mb-1 pl-3 title-produits text-center">
                        <strong><?php echo get_the_title(); ?></strong>
                    </a></div>
                    <div class="p-2 text-center w-100 reference-produit"><span data-aos="flip-right"><?php echo $product->get_sku(); ?></span></div>
                    <div class="mt-auto p-2 text-center w-100">
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
            <?php else: ?>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="row h-100">
                            <div class="col-lg-5 col-md-12 toshiba-image d-flex align-items-start justify-content-center">
                                <img class="img-fluid" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" />
                            </div>
                            <div class="col-lg-7 col-md-12 p-3 toshiba-product">
                                <h2>
                                    <?php echo get_the_title(); ?>
                                </h2>
                                <div class="mb-3">
                                    <?php echo $product->get_description(); ?>
                                </div>
                                <a href="mailto:toshiba.copieur@sidef.mg?subject=Toshiba imprimante&cc=faly.rajaomanarivo@sidef.mg" class="pt-2 pb-2 ps-4 pe-4 contact-expert">Contacter un expert</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
            <?php endwhile; wp_reset_query();?>
        <div class="mt-5 text-center" data-aos="flip-left">
            <?php wp_pagenavi();?>
        </div>
        <?php endif; ?>
    </div>
    
</div>

<?php get_footer(); ?>
