<?php

/**

 * Template Name: Page confirmation commande

 */
get_header();
?>

<section class="mb-4">
    <div class="container">
        <?php get_template_part( 'parts/revenir',
                        null,
                        array(
                            'revenir'   => 'Panier',
                            'lien'   => '/panier'
                        )); ?>
        
        <div class="row mb-3 validation-cmd">
            <h2 class="col-lg-5 col-md-6 col-sm-12 p-2">Validation de votre commande</h2>
        </div>
        
        <div class="row">
            <?php echo do_shortcode('[woocommerce_checkout]'); ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>

