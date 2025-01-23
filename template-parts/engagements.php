<?php

/**

 * Template Name: engagement

 */


get_header();
?>

<section id="sectwrapper" class=" mb-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-md-10 col-12">
                <?php get_template_part( 'parts/revenir',
                        null,
                        array(
                            'revenir'   => '',
                            'lien'   => ''
                        ) ); ?>
            </div>
        </div>
        
        
        <?php if( have_rows('contenu') ):
                while( have_rows('contenu') ): the_row(); ?>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-md-10 col-12"><?php echo get_sub_field('content'); ?></div>
            <div class="col-lg-10 col-md-10 col-12 mb-5"><?php echo get_sub_field('titre_client'); ?></div>
            <div class="col-lg-10 col-md-10 col-12 carous-client owl-carousel owl-theme">
                <?php foreach(get_sub_field('clients') as $clients): ?>
                <div class="item d-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="<?php echo $clients["url"]; ?>" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-10 col-md-10 col-12 mt-3 mb-3">
                <?php echo get_sub_field('magasin'); ?>
            </div>
        </div>
        <?php
            endwhile;
        endif; ?>
        
        
    </div>
</section>
<?php get_footer(); ?>

