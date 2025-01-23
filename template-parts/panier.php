<?php

/**

 * Template Name: Page panier

 */


//rehefa manao maj panier de tokony miova ko le cart eo ambony na tsy asina acart tsony ftsn

get_header();
?>

<section id="sectwrapper" class=" mb-5">
    <div class="container">
        <?php get_template_part( 'parts/revenir',
                        null,
                        array(
                            'revenir'   => '',
                            'lien'   => ''
                        ) ); ?>
        <div class="row mb-3 validation-cmd">
            <h2 class="col-lg-5 col-md-6 col-sm-12 p-2" data-aos="fade-down-right">Votre panier</h2>
        </div>
        
        <div class="row" data-aos="fade-up">
            <?php echo do_shortcode('[woocommerce_cart]'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>

