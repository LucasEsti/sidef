<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>

    <footer id="contact" class="pt-5 pb-5" style="background: url('<?php echo get_field('background', 'option')['url']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center mb-3">
                    <img id="logoSidef_foot" class="animate__animated" src="<?php echo get_field('logo', 'option')['url']; ?>" alt="<?php echo get_field('logo', 'option')['alt']; ?>" >
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mb-3">
                    <h2 style="font-size: xxx-large; color: white;"><?php echo get_field('titre', 'option'); ?></h2>
                </div>
            </div>
            <div class="row d-flex align-items-center justify-content-center ">
                <?php 
                $localisation_repeteur = get_field('localisation_repeteur', 'option');
                foreach ($localisation_repeteur as $loc_rep): ?>
                    <div class="<?php echo $loc_rep['class']; ?>" style="<?php echo $loc_rep['style_avant']; ?>">
                        <div class="text-center text-white" ><b><?php echo $loc_rep['localisation']; ?></b></div>
                        <div class="text-center" >
                            <?php foreach ($loc_rep['mail'] as $mail): ?>
                                <a href="mailto:<?php echo $mail['mail']; ?>" class="text-white"><?php echo $mail['mail']; ?></a>
                            <?php endforeach; ?>

                        </div>
                        <?php foreach ($loc_rep['phone_repeteur'] as $phone): ?>
                        <div class="text-center">
                            <a class="text-white" href="tel:<?php echo $phone['numero']; ?>"><?php echo $phone['numero']; ?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </footer>
    <!--//asina copyright-->
    </div>
    <?php wp_footer(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- GA Google Analytics @ https://m0n.co/ga -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y1CEYC95HH"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('consent', 'update', {
                ad_user_data: 'granted',
                ad_personalization: 'granted',
                ad_storage: 'granted',
                analytics_storage: 'granted'
              });
			gtag('js', new Date());
			gtag('config', 'G-Y1CEYC95HH');
			
			
		</script>
    <script>
        
        $(document).ready(function() {
            
            AOS.init({
                duration: 900,
            });
            
            //animate texte 
//            var textCommande = $('#e');
//            textCommande.addClass(textCommande.data('animate'));
//                setTimeout(function(){
//                    logo.removeClass("rotateIn animated");
//                }, 1000);
            
            var logo = $('#logoSidef');
            var logo_footer = $('#logoSidef_foot');
            $('#exampleModalCenter').modal('show');
            
            logo.hover(
                function() {
                    logo.addClass('animate__rotateIn');
                }, function() {
                    logo.removeClass("animate__rotateIn");
                }
            );
            
            logo_footer.hover(
                function() {
                    logo_footer.addClass('animate__rotateIn');
                }, function() {
                    logo_footer.removeClass("animate__rotateIn");
                }
            );
            $('.ajax_add_to_cart').on('click', function () {
                    var cart = '';
                    if( $('.cart-lg').css('display') != 'none') {
                        cart = $('.cart-lg-1');
                    } else {
                        cart = $('.cart-lg-2');
                    }
                    
                    var cart_shop = $('.menu-cart');
                    var cartClick = $(this).find('i');

                    var imgtodrag = $(this).parent('div').parent('.element-item').find("img").eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({
                            top: imgtodrag.offset().top,
                            left: imgtodrag.offset().left
                        })
                            .css({
                            'opacity': '0.8',
                                'position': 'absolute',
                                'height': '150px',
                                'width': '150px',
                                'z-index': '100'
                        })
                            .appendTo($('body'))
                            .animate({
                            'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 75,
                                'height': 75
                        }, 1000, 'easeInOutExpo');

                        setTimeout(function () {
                            cartClick.effect("bounce", {
                                times: 2
                            }, 200);
                            cart_shop.effect("bounce", {
                                times: 2
                            }, 200);
                        }, 1500);

                        imgclone.animate({
                            'width': 0,
                                'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                });
            
            
            $('.carous-logo').owlCarousel({
		loop: false,
		nav: false,
                dots: false,
		pagination: false,
                autoplay:false,
                
		responsive: {
			0: {
                            items: 3,
                            margin: 15
			},
			600: {
                            items: 3,
                            margin: 50
			},
			1000: {
                            items: 3,
                            margin: 20
			}
		}
            });
            $('.carous-client').owlCarousel({
		loop: false,
		margin: 0,
		nav: true,
                dots: true,
                navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		pagination: false,
                autoplay:false,
                margin:10,
		responsive: {
			0: {
                            items: 2
			},
			600: {
                            items: 3
			},
			1000: {
                            items: 6,
                            margin:100,
			}
		}
            });
            
            $('.carous-livraison').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
                dots: true,
                navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		pagination: false,
                autoplay:true,
                margin:10,
                autoplayTimeout:6000,
                autoplaySpeed: 2000,
		responsive: {
			0: {
                            items: 1
			},
			600: {
                            items: 2
			},
			1000: {
                            items: 3
			}
		}
            });
            
            $('.carous-promo').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
                dots: true,
                navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		pagination: false,
                autoplay:true,
                margin:10,
                autoplayTimeout:5000,
                autoplaySpeed: 1000,
		responsive: {
			0: {
                            items: 2
			},
			600: {
                            items: 3
			},
			1000: {
                            items: 5
			}
		}
            });
            $('.owl-carousel').owlCarousel({
		//loop: $('.owl-prod img').lenght > 1 ? false : true,
		margin: 0,
		nav: false,
                dots: false,
		pagination: false,
                autoplay:true,
                autoplayTimeout:8000,
                autoplaySpeed: 1000,
		responsive: {
			0: {
                            items: 1
			},
			600: {
                            items: 1
			},
			1000: {
                            items: 1
			}
		}
            });
            AOS.refresh();
            
        });
    </script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10942608044">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-10942608044');
</script>
</body>
</html>
