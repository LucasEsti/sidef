<?php
/**
**  activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
//    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

function mytheme_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mytheme_post_thumbnails' );

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 18;
  return $cols;
}

// Site option
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Site options',
        'menu_title' 	=> 'Site options',
        'menu_slug' 	=> 'site_options',
        'capability' 	=> 'edit_posts',
        'position' => 4,
        'redirect'		=> false,
    ));
}

function customtheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'customtheme_add_woocommerce_support' );

add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}

function lv2_add_bootstrap_input_classes( $args, $key, $value = null ) {
    switch ( $args['type'] ) {
        case "select" :  /* Targets all select input type elements, except the country and state select input types */
            $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
            $args['input_class'] = array('form-control', 'input-lg'); // Add a class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class'] = array('control-label');
            $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
        break;

        case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
            $args['class'][] = 'form-group single-country';
            $args['label_class'] = array('control-label');
        break;

        case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
            $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
            $args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class'] = array('control-label');
            $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
        break;


        case "password" :
        case "text" :
        case "email" :
        case "tel" :
        case "number" :
            $args['class'][] = 'form-group';
            //$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
        break;

        case 'textarea' :
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
        break;

        case 'checkbox' :
        break;

        case 'radio' :
        break;

        default :
            $args['class'][] = 'form-group';
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
        break;
    }

    return $args;
}
add_filter('woocommerce_form_field_args','lv2_add_bootstrap_input_classes',10,3);

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'MGA': $currency_symbol = 'Ar TTC'; break;
     }
     return $currency_symbol;
}
//** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action( 'wp_footer', 'trigger_for_ajax_add_to_cart' );
function trigger_for_ajax_add_to_cart() {
    ?>
        <script type="text/javascript">
            (function($){
                $('body').on( 'added_to_cart', function(){
                    const element = document.querySelector('.fa-cart-shopping');
                    element.classList.add('animate__rubberBand');

                    element.addEventListener('animationend', () => {
                        $(".fa-cart-shopping").removeClass("animate__rubberBand");
                    });

//                    let total = parseInt($('.cart-customlocation').attr('items')) + 1;
//                    $('.cart-customlocation').attr('items', total);
//                    $('.cart-customlocation').attr('title', total + ' produits');
                });
            })(jQuery);
        </script>
    <?php
}

// Cart page (and mini cart)
add_filter( 'woocommerce_cart_item_name', 'cart_item_product_description', 20, 3);
function cart_item_product_description( $item_name, $cart_item, $cart_item_key ) {
    $title = $cart_item['data']->get_title();
    if ( ! is_checkout() ) {
        
        if( $cart_item['variation_id'] > 0 ) {
            $description = $cart_item['data']->get_description(); // variation description
        } else {
            $description = $cart_item['data']->get_short_description(); // product short description (for others)
        }

        if ( ! empty($description) ) {
            return $title;
        }
    }
    return $title;
}

// Checkout page
add_filter( 'woocommerce_checkout_cart_item_quantity', 'cart_item_checkout_product_description', 20, 3);
function cart_item_checkout_product_description( $item_quantity, $cart_item, $cart_item_key ) {
    $title = $cart_item['data']->get_title();
    if( $cart_item['variation_id'] > 0 ) {
        $description = $cart_item['data']->get_description(); // variation description
    } else {
        $description = $cart_item['data']->get_short_description(); // product short description (for others)
    }

    if ( ! empty($description) ) {
        return $title;
    }

    return $title;
}
// Force displaying variation attributes in the product name (in cart/minicart/checkout)
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_true' );
// (Optional) Force displaying product variation attributes as separated formatted metadata (in cart/minicart/checkout)
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );

//hide if price = 0
add_filter( 'woocommerce_get_price_html','maybe_hide_price',10,2);
function maybe_hide_price($price_html, $product){
     if($product->get_price() > 1){
          return $price_html;
     }
     return "<a class='devis' href='mailto:commercial@sidef.mg?cc=omar.abdoulaziz@sidef.mg, webmaster@fitaratra.mg&subject=".$product->get_title().', reference = '. $product->get_sku(). "'>Demander un devis</a>";
 } 
 
//hide add cart price 0
function remove_add_to_cart_on_0 ( $purchasable, $product ){
    if( $product->get_price() == 1 )
        $purchasable = false;
    return $purchasable;
}
add_filter( 'woocommerce_is_purchasable', 'remove_add_to_cart_on_0', 10, 2 );

add_filter( 'woocommerce_cart_item_price', 'bbloomer_change_cart_table_price_display', 30, 3 );

function bbloomer_change_cart_table_price_display( $price, $values, $cart_item_key ) {
$slashed_price = $values['data']->get_price_html();
$is_on_sale = $values['data']->is_on_sale();
if ( $is_on_sale ) {
$price = $slashed_price;
}
return $price;
}


/*
 * Add Revision support to WooCommerce Products
 * 
 */

add_filter( 'woocommerce_register_post_type_product', 'cinch_add_revision_support' );

function cinch_add_revision_support( $supports ) {
     $supports['supports'][] = 'revisions';

     return $supports;
}
?>