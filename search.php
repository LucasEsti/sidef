<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

<?php get_template_part( 'parts/other' ); ?>
    <?php get_template_part( 'parts/revenir' ); ?>

<?php if (have_posts()) : ?>
<section id="nouveaux" class="container">
	<div class="row mb-5">
                <?php while (have_posts()) : the_post(); global $product; ?>
                        <div class="element-item d-flex align-items-end flex-column col-lg-2 col-md-3 col-sm-12 mb-1 mt-5">
                            <div class="p-2 d-flex align-items-center justify-content-center border w-100 div-promo">
                                <img class="img-fluid" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" />
                                <?php if ($product->is_on_sale()): 
                                    ?>
                                    <img class="img-fluid img-promo" src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/icon_promo.webp" alt="" />
                                <?php endif; ?>
                            </div>
                            <div class="w-100 d-flex align-items-start flex-column" style="height: 150px;">
                                <div class="p-2"><a href="<?php echo get_permalink(); ?>" class="row mb-1 pl-3 title-produits text-center">
                                    <strong><?php echo get_the_title(); ?></strong>
                                </a></div>
                                <div class="p-2 text-center w-100 reference-produit"><span><?php echo $product->get_sku(); ?></span></div>
                                <div class="mt-auto p-2 text-center w-100">
                                    <?php if ($product->get_regular_price()): ?>
                                            <?php if ($product->get_regular_price() > 1): 
                                                if ($product->is_on_sale()): ?>   
                                                    <div class="promo_prix"><del><?php echo number_format( $product->get_regular_price(), 0, ',', ' '); ?></del> Ar ttc</div>
                                                <?php endif; ?>
                                                <span><strong><?php echo number_format( $product->get_price(), 0, ',', ' '); ?></strong> Ar ttc
                                                <?php if ($product->get_sku() == "TETS3218" || $product->get_sku() == "TEKY43122SM"): ?>
                                                    <button type="button" style="border: none;background: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="dont un remboursement par bon d'achat de 200.000Ar">
                                                            *
                                                          </button>
                                                    <?php endif; ?>
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
                <?php endwhile; ?>
		<div class="col-sm-12 mt-5 text-center">
			<?php wp_pagenavi();?>
		</div>
	</div>
</section>
<?php else : ?>
        <section class="container">
                <div class="row mb-5 mt-5">
                        <div class="col-sm-12 text-center">
                                <h3>0 resultat pour : <?php echo get_search_query(); ?></h3>
                        </div>
                </div>
        </section>
<?php endif; ?>
<?php
get_footer();
