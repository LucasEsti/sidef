<?php
$queried_object = get_queried_object(); 
global $post;;
$terms = false;
if ($post) {
    $terms = get_the_terms( $post->ID, 'product_cat' );
}

    
if($terms && $terms[0]->parent != 0 ) {
    $terms = array_reverse($terms, false);
}

if (isset($args['revenir'])) {
    $revenir = $args['revenir']; 
    
    $lien = $args['lien'];
}

//var_dump($queried_object->post_parent);die;
?>
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-6 col-md-12 col-12 d-flex align-items-center">
            <nav aria-label="breadcrumb" class="container">
                <ol class="breadcrumb" data-aos="fade-up">
                    <li class="breadcrumb-item"><a class="revenir-accueil" href="/" ><i class="fa-solid fa-caret-left"></i> Accueil</a></li>
                    
                    <?php
//                    if($queried_object && $queried_object->parent != 0) { ?>
                    <!--<li class="breadcrumb-item"><a href="<?php // echo get_term_link(get_term($queried_object->parent)->term_id) ?>"><?php // echo get_term($queried_object->parent)->name; ?></a></li>-->
                    <?php // } ?>
                    
                    <?php if(isset($args['revenir'])) { ?>
                        
                        <?php if (strlen($revenir) == 0) { ?>
                    
                        <?php } else { ?>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $lien; ?>"><?php echo $revenir; ?></a></li>
                        <?php } ?>
                    <?php } elseif(is_product_category()) { ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php single_cat_title(); ?></li>
                    <?php } else { ?>
                        
                        <?php 
                         if ($terms) {
                             foreach ( $terms as $term ) { ?>
                            <li class="breadcrumb-item">
                                <a href="<?php echo get_term_link($term->term_id); ?>">
                                    <?php echo  $term->name ; ?>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                    <?php }
                    }
                    ?>
                        
                    
                </ol>
            </nav>
        </div>
        <div class="col-lg-6 col-md-12 col-12" data-aos="fade-right"><?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?></div>
    </div>
</div>



