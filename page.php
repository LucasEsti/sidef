<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

    <?php // get_template_part( 'parts/other' ); ?>
    <?php get_template_part( 'parts/revenir' ,
                        null,
                        array(
                            'revenir'   => '',
                            'lien'   => ''
                        ) ); ?>
	<div id="primary" class="content-area container mt-5 mb-5">
            
		<main id="main" class="site-main">

			<?php

			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
                <?php 
                $contenu = get_field('contenu');

                if ($contenu != false):?>
                <div class="row">
                    <?php echo $contenu; ?>
                </div>
                <?php endif; ?>
	</div><!-- #primary -->

<?php
get_footer();
